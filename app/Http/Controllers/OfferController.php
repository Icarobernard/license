<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class OfferController extends Controller
{
    public function index()
    {
        $offers = Offer::all();
        return view('offers.index', compact('offers'));
    }

    public function create()
    {
        $products = Product::all();
        return view('offers.create-edit', compact('products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:subscription,lifetime'],
            'subscription_type' => ['nullable', 'in:annual,monthly,weekly'],
            'subscription_quantity' => ['nullable', 'integer', 'min:1'],
            'is_visible' => ['nullable', 'string'],
            'utm_source' => ['nullable', 'string', 'max:255'],
            'utm_campaign' => ['nullable', 'string', 'max:255'],
            'utm_medium' => ['nullable', 'string', 'max:255'],
            'utm_term' => ['nullable', 'string', 'max:255'],
            'utm_content' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'licenses' => ['required', 'integer', 'min:1'],
            'price' => ['nullable', 'numeric', 'min:1'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $offer = new Offer();
        $offer->name = $request->name;
        $offer->product_id = $request->product_id;
        $offer->type = $request->type;
        if ($request->type == 'subscription') {
            $offer->subscription_type = $request->subscription_type;
            $offer->subscription_quantity = $request->subscription_quantity;
        }
        if ($request->is_visible) {
            $offer->is_visible = true;
            $offer->utm_source = $request->utm_source;
            $offer->utm_campaign = $request->utm_campaign;
            $offer->utm_medium = $request->utm_medium;
            $offer->utm_term = $request->utm_term;
            $offer->utm_content = $request->utm_content;
            $offer->url = $request->url;
            $offer->price = $request->price;
        } else {
            $offer->is_visible = false;
        }
        $offer->licenses = $request->licenses;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('uploads', 'public');
            $offer->image = $imagePath;
        }
        $offer->save();

        return redirect()->route('offers.index')->with('success', 'Oferta criada com sucesso!');
    }

    public function find($id)
    {
        $offer = Offer::findOrFail($id);
        $products = Product::all();
        return view('offers.create-edit', compact('offer', 'products'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'product_id' => ['required', 'exists:products,id'],
            'type' => ['required', 'in:subscription,lifetime'],
            'subscription_type' => ['nullable', 'in:annual,monthly,weekly'],
            'subscription_quantity' => ['nullable', 'integer', 'min:1'],
            'licenses' => ['required', 'integer', 'min:1'],
            'is_visible' => ['nullable', 'string'],
            'utm_source' => ['nullable', 'string', 'max:255'],
            'utm_campaign' => ['nullable', 'string', 'max:255'],
            'utm_medium' => ['nullable', 'string', 'max:255'],
            'utm_term' => ['nullable', 'string', 'max:255'],
            'url' => ['nullable', 'string', 'max:255'],
            'utm_content' => ['nullable', 'string', 'max:255'],
            'price' => ['nullable', 'numeric', 'min:1'],
            'image' => ['nullable', 'image', 'mimes:jpeg,png,jpg,gif', 'max:2048'],
        ]);

        $offer = Offer::findOrFail($id);
        $offer->name = $request->name;
        $offer->product_id = $request->product_id;
        $offer->type = $request->type;
        $offer->licenses = $request->licenses;
        if ($request->type == 'subscription') {
            $offer->subscription_type = $request->subscription_type;
            $offer->subscription_quantity = $request->subscription_quantity;
        } else {
            $offer->subscription_type = null;
            $offer->subscription_quantity = null;
        }
        if ($request->is_visible) {
            $offer->is_visible = true;
            $offer->utm_source = $request->utm_source;
            $offer->utm_campaign = $request->utm_campaign;
            $offer->utm_medium = $request->utm_medium;
            $offer->utm_term = $request->utm_term;
            $offer->utm_content = $request->utm_content;
            $offer->url = $request->url;
            $offer->price = $request->price;
        } else {
            $offer->is_visible = false;
        }
        if ($request->hasFile('image')) {
            // Excluir a imagem antiga se existir
            if ($offer->image) {
                Storage::disk('public')->delete($offer->image);
            }
            $imagePath = $request->file('image')->store('uploads', 'public');
            $offer->image = $imagePath;
        }
        $offer->save();

        return redirect()->route('offers.index')->with('success', 'Oferta atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);

        if ($offer->product->user_id != Auth::id()) {
            return redirect()->route('offers.index')->with('error', 'Você não tem permissão para deletar esta oferta.');
        }
        if ($offer->image) {
            Storage::disk('public')->delete($offer->image);
        }
        $offer->delete();

        return redirect()->route('offers.index')->with('success', 'Oferta deletada com sucesso.');
    }
    public function plans($productName = null)
    {
        if ($productName) {
            $product = Product::where('name', 'LIKE', '%' . $productName . '%')->first();

            if ($product) {
                $offersVisible = Offer::where('product_id', $product->id)
                    ->where('is_visible', 1)
                    ->orderBy('name', 'asc')
                    ->get();
            } else {
                $offersVisible = Offer::where('is_visible', 1)
                    ->orderBy('name', 'asc')
                    ->get();
            }
        } else {
            $offersVisible = Offer::where('is_visible', 1)
                ->orderBy('name', 'asc')
                ->get();
        }

        return view('plans', compact('offersVisible'));
    }
}
