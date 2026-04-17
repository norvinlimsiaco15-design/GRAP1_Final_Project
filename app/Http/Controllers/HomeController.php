<?php

namespace App\Http\Controllers;

use App\Models\Design;
use App\Models\Product;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index(): View
    {
        return view('home', [
            'featuredProducts' => Product::with('category')->latest()->take(8)->get(),
            'designs' => Design::latest()->take(6)->get(),
        ]);
    }
}
