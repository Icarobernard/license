<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Content;
use App\Http\Controllers\DomainController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    public function index()
    {
        $contents = Content::orderBy('rank', 'asc')->get();
        $products = Product::orderBy('rank', 'asc')->get();
        return view('products.index', compact('products', 'contents'));
    }

    public function create()
    {
        return view('products.create-edit');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'product_id' => ['required', 'string', 'unique:products'],
            'payment_type' => ['required', 'string', 'max:255'],
            'unlimited_subdomain_id' => ['nullable', 'string'],
            'support_id' => ['nullable', 'string'],
            'update_id' => ['nullable', 'string'],
            'image' => ['required', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'is_free' => ['nullable', 'string'],
            'custom_url' => ['nullable', 'string'],
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->product_id = $request->product_id;
        $product->payment_type = $request->payment_type;
        $product->unlimited_subdomain_id = $request->unlimited_subdomain_id;
        $product->support_id = $request->support_id;
        $product->update_id = $request->update_id;
        $product->is_free = $request->is_free;
        if($request->custom_url) {
            $domain = new DomainController();
            $product->custom_url = $domain->sanitizeDomain($request->custom_url);
        }
        
        $maxRank = Product::max('rank');
        $product->rank = $maxRank + 1;
        $product->user_id = Auth::id();
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $product->image = $imagePath;
        }
        if ($request->is_free) {
            $product->is_free = true;
        } else {
            $product->is_free = false;
        }
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    public function find($id)
    {
        $product = Product::findOrFail($id);
        $contents = Content::where('product_id',  $id)->orderBy('rank', 'asc')->get();
        return view('products.create-edit', compact('product', 'contents'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'product_id' => ['required', 'string', 'unique:products,product_id,' . $id],
            'payment_type' => ['required', 'string', 'max:255'],
            'unlimited_subdomain_id' => ['nullable', 'string'],
            'support_id' => ['nullable', 'string'],
            'update_id' => ['nullable', 'string'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
            'custom_url' => ['nullable', 'string'],
            'is_free' => ['nullable', 'string']
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->product_id = $request->product_id;
        $product->payment_type = $request->payment_type;
        $product->unlimited_subdomain_id = $request->unlimited_subdomain_id;
        $product->support_id = $request->support_id;
        $product->update_id = $request->update_id;
        if ($request->is_free) {
            $product->is_free = true;
        } else {
            $product->is_free = false;
        }

        if($request->custom_url) {
            $domain = new DomainController();
            $product->custom_url = $domain->sanitizeDomain($request->custom_url);
        }
        if ($request->hasFile('image')) {
            // Excluir a imagem antiga se existir
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('uploads', 'public');
            $product->image = $imagePath;
        }
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->user_id != Auth::id()) {
            return redirect()->route('products.index')->with('error', 'Você não tem permissão para deletar este produto.');
        }
        if ($product->image) {
            Storage::disk('public')->delete($product->image);
        }
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso.');
    }

    public function moveUp($id)
    {
        $product = Product::findOrFail($id);
        $previousProduct = Product::where('rank', '<', $product->rank)->orderBy('rank', 'desc')->first();

        if ($previousProduct) {
            $previousRank = $previousProduct->rank;
            $previousProduct->rank = $product->rank;
            $previousProduct->save();

            $product->rank = $previousRank;
            $product->save();
        }

        return redirect()->route('products.index');
    }

    public function moveDown($id)
    {
        $product = Product::findOrFail($id);
        $nextProduct = Product::where('rank', '>', $product->rank)->orderBy('rank', 'asc')->first();

        if ($nextProduct) {
            $nextRank = $nextProduct->rank;
            $nextProduct->rank = $product->rank;
            $nextProduct->save();

            $product->rank = $nextRank;
            $product->save();
        }

        return redirect()->route('products.index');
    }
}
