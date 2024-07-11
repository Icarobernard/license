<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            'licenses' => ['required', 'integer', 'min:1'],
        ]);

        $offer = new Offer();
        $offer->name = $request->name;
        $offer->product_id = $request->product_id;
        $offer->type = $request->type;
        $offer->licenses = $request->licenses;
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
            'licenses' => ['required', 'integer', 'min:1'],
        ]);

        $offer = Offer::findOrFail($id);
        $offer->name = $request->name;
        $offer->product_id = $request->product_id;
        $offer->type = $request->type;
        $offer->licenses = $request->licenses;
        $offer->save();

        return redirect()->route('offers.index')->with('success', 'Oferta atualizada com sucesso!');
    }

    public function destroy($id)
    {
        $offer = Offer::findOrFail($id);

        if ($offer->product->user_id != Auth::id()) {
            return redirect()->route('offers.index')->with('error', 'Você não tem permissão para deletar esta oferta.');
        }

        $offer->delete();

        return redirect()->route('offers.index')->with('success', 'Oferta deletada com sucesso.');
    }
}
