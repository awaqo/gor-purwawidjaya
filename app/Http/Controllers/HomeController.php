<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\CourtImages;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $weekMap = [
            0 => 'Min',
            1 => 'Sen',
            2 => 'Sel',
            3 => 'Rab',
            4 => 'Kam',
            5 => 'Jum',
            6 => 'Sab',
        ];
        $dayOfTheWeek = Carbon::now()->dayOfWeek;
        $weekday = $weekMap[$dayOfTheWeek];

        $today = Carbon::now()->format('H');

        $courts = CourtImages::select('id', 'court_id', 'image')
            ->with('court')
            // ->distinct()
            ->groupBy('court_id')
            ->get();

        if ($weekday == 'Min' || $weekday == 'Sab')
        {
            $schedules = Schedule::get();
        } else {
            $schedules = Schedule::where('id', '>=', 11)->get();
        }
        $date = date('l');

        return view('customer.index', compact('weekday', 'courts', 'schedules', 'today', 'date'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
