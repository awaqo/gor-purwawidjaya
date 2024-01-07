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
            ->select('transactions.*', 'bookings.booking_name', 'bookings.date', 'courts.court_name', 'users.name')
            ->orderBy('transactions.created_at')
            ->distinct()
            ->get();

        $BkTime = Booking::get();
        $Timer = Schedule::get();

        return view('customer.index', compact('courts', 'date', 'lastBook', 'Transaction', 'BkTime', 'Timer'));
    }

    public function updateStatus(Request $request)
    {
        Transaction::where('booking_id', $request->bookingid)->update(['order_status' => 'completed']);
    }
}
