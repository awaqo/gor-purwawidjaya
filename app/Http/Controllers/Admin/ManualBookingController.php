<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\CourtImages;
use App\Models\Schedule;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ManualBookingController extends Controller
{
    public function index()
    {
        $date = Carbon::now()->isoFormat('Y-M-D');
        $lastBook = Booking::latest()->first();
        $courtList = CourtImages::select('id', 'court_id', 'image')
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

        return view('admin.manual-booking.index', compact('courtList', 'date', 'lastBook', 'Transaction', 'BkTime', 'Timer'));
    }

    public function detailCourt($id, $slug)
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

        if ($weekday == 'Min' || $weekday == 'Sab')
        {
            $schedules = Schedule::get();
        } else {
            $schedules = Schedule::where('id', '>=', 11)->get();
        }

        $date = Carbon::now()->isoFormat('dddd');
        
        $court = CourtImages::with('court')
            ->where('court_id', $id)
            ->get();
        
        $booked_schedule = Booking::get();
        $latest = Booking::latest('id')->first();
        $checkBooked = DB::table('transactions')
            ->join('bookings', 'transactions.booking_id', '=', 'bookings.booking_id')
            ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
            ->select('transactions.*', 'bookings.*', 'schedules.*')
            ->get();
        return view('admin.manual-booking.admin-booking', compact('startDate', 'endDate', 'court', 'schedules', 'date', 'booked_schedule', 'latest', 'checkBooked'));
    }

    public function bookCourt(Request $request)
    {
        $request->validate([
            'payment_metode' => 'required'
        ]);

        $data = $request->all();
        $validated = $request->validate([
            'payment_metode' => 'required',
        ]);

        $selectedSchedule = $request->input('selectedSchedule', []);

        $user_id = Auth::user()->id;
        $court_id = $data['court_id'];
        $unique_code = rand(100, 999);
        $price = 0;

        foreach ($selectedSchedule as $scheduleID) {
            $selectSchedule = Schedule::where('id', $scheduleID)->first();
            $pt = $selectSchedule->timeStart.".00-".$selectSchedule->timeEnd.".00";
            $price += $selectSchedule->price;
            
            Booking::create([
                'booking_id' => $data['booked_id'],
                'schedule_id' => $scheduleID,
                'play_time' => $pt,
                'booking_name' => $data['name'],
                'date' => $data['datepick'],
            ]);
        }

        $total = ($price + $unique_code);

        Transaction::create([
            'user_id' => $user_id,
            'court_id' => $court_id,
            'booking_id' => $data['booked_id'],
            'unique_payment_code' => $unique_code,
            'total' => $total,
            'payment_metode' => $validated['payment_metode'],
            'payment_status' => 'paid',
            'order_status' => 'confirmed',
        ]);

        return redirect('/admin/dashboard')->with('successBooking', 'Data booking pelanggan berhasil diinput');
    }

    public function checkSch(Request $request) {
        $data = DB::table('bookings')
            ->join('transactions', 'transactions.booking_id', '=', 'bookings.booking_id')
            ->select('transactions.court_id', 'bookings.*')
            ->where('bookings.date', '=', $request->date)
            ->get();
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
}
