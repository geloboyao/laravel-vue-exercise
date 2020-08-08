<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller as Controller;

class SortController extends Controller
{
    public function index()
    {
        return view('layout')
            ->with('title', 'Sort');
    }

    public function show(Request $request)
    {
    }

    public function test()
    {
    }
}
