<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    /**
     * Display the about page
     */
    public function index()
    {
        $branches = Branch::active()->sorted()->get();
        
        return view('about', compact('branches'));
    }
}
