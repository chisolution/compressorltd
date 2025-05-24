<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LegalController extends Controller
{
    /**
     * Display the privacy policy page
     */
    public function privacy()
    {
        return view('legal.privacy');
    }

    /**
     * Display the warranty page
     */
    public function warranty()
    {
        return view('legal.warranty');
    }

    /**
     * Display the terms of service page
     */
    public function terms()
    {
        return view('legal.terms');
    }
}
