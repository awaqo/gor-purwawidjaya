<?php

namespace App\Http\Controllers;

use App\Models\Booking;
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
        $date = Carbon::now()->isoFormat('Y-M-D');
        $lastBook = Booking::latest()->first();
        $courts = CourtImages::select('id', 'court_id', 'image')
            ->with('court')
            // ->distinct()
            ->groupBy('court_id')
            ->get();
        
        $Transaction = DB::table('transactions')
            ->join('bookings', 'transactions.booking_id', '=', 'bookings.booking_id')
            ->join('courts', 'courts.id', '=', 'transactions.court_id')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->select('transactions.*', 'bookings.booking_name', 'bookings.date', 'courts.*', 'users.*')
            ->orderBy('transactions.created_at')
            ->distinct()
            ->get();
        
        // $Transaction = Transaction::with(['user', 'court', 'booking'])
        //     ->orderBy('created_at')
        //     ->get();
        
        $BkName = Booking::get();

        $BkTime = Booking::get();

        return view('customer.index', compact('courts', 'date', 'lastBook', 'Transaction', 'BkTime', 'BkName'));
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
