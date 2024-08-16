<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Product;
use App\Models\Content;

class MobileController extends Controller
{
    // Método para autenticação simples
    public function authenticate(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json([
                'status' => 'success',
                'user' => $user,
            ]);
        }

        return response()->json(['status' => 'error', 'message' => 'Unauthorized'], 401);
    }


    public function getProductsWithContents()
    {
        $products = Product::with(['contents' => function ($query) {
            $query->where('status', 'published')->orderBy('rank', 'asc');
        }])->get();

        return response()->json($products);
    }
}