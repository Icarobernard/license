<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\License;
use App\Models\Product;
use App\Models\Content;
use Illuminate\Support\Facades\Auth;

class MemberAreaController extends Controller
{
    public function index()
    {
        $products = Product::orderBy('rank', 'asc')->get();
        return view('vitrine.index', compact('products'));
    }

    public function select($id)
    {
        $contents = Content::where('product_id', $id)->where('status', 'published')->orderBy('rank', 'asc')->get();
        $product = Product::findOrFail($id);
        $validateLicense = $this->hasActiveLicense($product->product_id);
        if ($validateLicense ||  $product->is_free) {
            return view('vitrine.select', compact('contents'));
        } else {
            return redirect('vitrine');
        }
    }
    public function find($id)
    {
        $content = Content::findOrFail($id);
        $product = Product::findOrFail($content->product_id);
        $validateLicense = $this->hasActiveLicense($product->product_id);
    
        if ($validateLicense || $product->is_free) {
            $nextContent = Content::where('product_id', $content->product_id)
                ->where('rank', '>', $content->rank)
                ->where('status', 'published')
                ->orderBy('rank', 'asc')
                ->first();
    
            $prevContent = Content::where('product_id', $content->product_id)
                ->where('rank', '<', $content->rank)
                ->where('status', 'published')
                ->orderBy('rank', 'desc')
                ->first();
    
            return view('vitrine.content', compact('content', 'nextContent', 'prevContent'));
        } else {
            return redirect('vitrine');
        }
    }
    

    public function hasActiveLicense($product_id)
    {
        $userEmail = Auth::user()->email;

        $hasLicense = License::where('email', $userEmail)
            ->where('status', 'active')
            ->where('verification_code', $product_id)
            ->exists();

        return $hasLicense;
    }
}
