<?php

namespace App\Http\Controllers;

use App\Models\Academy;
use Illuminate\Http\Request;
use App\Models\Maps;

class AcademyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $maps = Maps::get()->first();
        $academy = Academy::get();
        
        return view('customer.akademi.index', compact('maps', 'academy'));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $maps = Maps::get()->first();
        $detail_academy = Academy::where('slug', $slug)->first();
        
        return view('customer.akademi.detail', compact('maps', 'detail_academy'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Academy $academy)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Academy $academy)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Academy $academy)
    {
        //
    }
}
