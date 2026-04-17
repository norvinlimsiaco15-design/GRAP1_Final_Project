<?php

namespace App\Http\Controllers;

use App\Models\Design;
use Illuminate\View\View;

class DesignController extends Controller
{
    public function index(): View
    {
        return view('designs.index', [
            'designs' => Design::latest()->paginate(12),
        ]);
    }
}
