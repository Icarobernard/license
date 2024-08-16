<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\License;
use App\Models\Offer;
use App\Models\Product;
use App\Models\WebhookLog;
use Carbon\Carbon;

class HomeController extends Controller
{
    public function home()
    {
        $offersVisible = Offer::where('is_visible', 1)->get();

        if (auth()->user()->is_admin) {
            $licenses = new License();
            $products = new Product();
            $offers = new Offer();
            $licenseCount = $licenses->all()->count();
            $productCount = $products->all()->count();
            $offerCount = $offers->all()->count();
            $now = Carbon::now();
            $lastMonth = $now->subMonth();
            $licenseLastMounth = License::where('created_at', '>=', $lastMonth)->count();
            $totalAmount = License::sum('total_amount');

            $errorsToday = WebhookLog::where('created_at', '>=', Carbon::today())->count();
            return view('dashboard', compact('licenseCount', 'errorsToday', 'licenseLastMounth', 'productCount', 'offerCount', 'offersVisible', 'totalAmount'));
        } else {
            return view('dashboard', compact('offersVisible'));
        }
    }
}
