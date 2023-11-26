<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Schedule;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function detailCourt($slug)
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

        $startDate = Carbon::now()->format('Y-m-d');
        $endDate = Carbon::now()->addWeek(2)->format('Y-m-d');

        // $schedules = Schedule::get();
        // $b = $schedules->toArray();
        // dd($b[0]);
        if ($weekday == 'Min' || $weekday == 'Sab')
        {
            $schedules = Schedule::get();
        } else {
            $schedules = Schedule::where('id', '>=', 11)->get();
        }

        $court = DB::table('court_images')
            ->join('courts', 'court_images.court_id', '=', 'courts.id')
            ->select('court_images.image', 'court_images.court_id', 'courts.*')
            ->where('courts.slug', '=', $slug)
            ->get();
        
        $date = Carbon::now()->isoFormat('dddd');
        
        $booked_schedule = Booking::get();
        $latest = Booking::latest('id')->first();
        $checkBooked = DB::table('transactions')
            ->join('bookings', 'transactions.booking_id', '=', 'bookings.booking_id')
            ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
            ->select('transactions.*', 'bookings.*', 'schedules.*')
            ->get();
        return view('customer.transaction.index', compact('startDate', 'endDate', 'court', 'schedules', 'date', 'booked_schedule', 'latest', 'checkBooked'));
    }

    public function bookCourt(Request $request)
    {
        $request->validate([
            'payment_metode' => 'required'
        ]);

        $data = $request->all();
        $selectedSchedule = $request->input('selectedSchedule', []);

        $user_id = Auth::user()->id;
        $court_id = $data['court_id'];
        $price = 0;

        foreach ($selectedSchedule as $scheduleID) {
            $selectSchedule = Schedule::where('id', $scheduleID)->first();

            $price += $selectSchedule->price;
            // dd($price);
            Booking::create([
                'booking_id' => $data['booked_id'],
                'schedule_id' => $scheduleID,
                'name' => $data['name'],
                'date' => $data['datepick'],
            ]);
        }

        Transaction::create([
            'user_id' => $user_id,
            'court_id' => $court_id,
            'booking_id' => $data['booked_id'],
            'total' => $price,
            'payment_metode' => $data['payment_metode'],
        ]);

        return redirect('/')->with('successBooking', 'Terima kasih telah melakukan booking lapangan di GOR Purwawidjaya');
    }

    public function checkSch(Request $request) {
        $data = DB::table('bookings')
            ->join('transactions', 'transactions.booking_id', '=', 'bookings.booking_id')
            ->select('transactions.court_id', 'bookings.*')
            ->where('bookings.date', '=', $request->date)
            ->get();
        // $data = Booking::where('date', $request->date)->get();
        return response()->json($data);
    }

    public function showSchedule(Request $request) {
        if ($request->day == 'weekend')
        {
            $showSchedule = Schedule::get();
        } else {
            $showSchedule = Schedule::where('id', '>=', 11)->get();
        }

        return response()->json($showSchedule);
    }

    // public function updateStatus(Request $request) {
    //     Booking::where('date', $request->bookingDate)->where('status_id', 2)
    //         ->update([
    //             'status_id' => 1
    //         ]);
    // }
}
