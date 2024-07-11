<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::where('user_id', Auth::id())->get();
        return view('products.index', compact('products'));
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
        ]);

        $product = new Product();
        $product->name = $request->name;
        $product->product_id = $request->product_id;
        $product->user_id = Auth::id();
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produto criado com sucesso!');
    }

    public function find($id)
    {
        $product = Product::findOrFail($id);
        return view('products.create-edit', compact('product'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'product_id' => ['required', 'string', 'unique:products,product_id,' . $id],
        ]);

        $product = Product::findOrFail($id);
        $product->name = $request->name;
        $product->product_id = $request->product_id;
        $product->save();

        return redirect()->route('products.index')->with('success', 'Produto atualizado com sucesso!');
    }

    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        if ($product->user_id != Auth::id()) {
            return redirect()->route('products.index')->with('error', 'Você não tem permissão para deletar este produto.');
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Produto deletado com sucesso.');
    }
}
