<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\CourtImages;
use App\Models\Schedule;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $courts = CourtImages::select('id', 'court_id', 'image')
            ->with('court')
            // ->distinct()
            ->groupBy('court_id')
            ->get();
        
        $listBooking = DB::table('transactions')
            ->join('bookings', 'transactions.booking_id', '=', 'bookings.booking_id')
            ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
            ->join('courts', 'courts.id', '=', 'transactions.court_id')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->select('transactions.*', 'bookings.*', 'schedules.*', 'courts.*', 'users.*')
            ->orderBy('transactions.created_at')
            ->get();

        return view('customer.index', compact('courts', 'listBooking'));
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
