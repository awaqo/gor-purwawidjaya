<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Competition;
use App\Models\Maps;

class CompetitionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compe = Competition::get();
        $maps = Maps::get()->first();
        
        return view('customer.lomba.index', compact('compe', 'maps'));
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $detail_compe = Competition::where('slug', $slug)->first();
        $maps = Maps::get()->first();
        
        return view('customer.lomba.detail', compact('detail_compe', 'maps'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
