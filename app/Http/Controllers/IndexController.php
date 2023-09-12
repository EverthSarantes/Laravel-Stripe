<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class IndexController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('index', compact('products'));
    }

    public function purcheases()
    {
        $purchases = Auth::user()->purchases;
        $products = [];
        foreach ($purchases as $purchase) {
            $products[] = $purchase->product;
        }

        return view('purcheases', compact('products'));
    }
}
