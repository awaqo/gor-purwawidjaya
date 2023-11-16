<?php

namespace App\Http\Controllers;

use App\Models\BookedSchedule;
use App\Models\Court;
use App\Models\CourtImages;
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

        $today = Carbon::now()->format('H');

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
        // $court = CourtImages::latest('id')->first();
        $date = date('l');
        // dd($court);
        $booked_schedule = BookedSchedule::get();
        $latest = BookedSchedule::latest('id')->first();
        // $checkBooked = BookedSchedule::where('booked_id', $checkAvail[0]->booked_id)->first();
        $checkBooked = DB::table('transactions')
            ->join('booked_schedules', 'transactions.booked_id', '=', 'booked_schedules.booked_id')
            ->select('transactions.*', 'booked_schedules.*')
            ->get();

        // dd($checkBooked);

        return view('customer.transaction.index', compact('weekday', 'court', 'schedules', 'today', 'date', 'booked_schedule', 'latest', 'checkBooked'));
    }

    public function bookCourt(Request $request)
    {
        $request->validate([
            'payment_metode' => 'required'
        ]);

        $data = $request->all();
        // dd($data);
        $selectedSchedule = $request->input('selectedSchedule', []);

        $user_id = Auth::user()->id;
        $court_id = $data['court_id'];
        $price = 0;
        // dd($data);

        foreach ($selectedSchedule as $scheduleID) {
            $selectSchedule = Schedule::where('id', $scheduleID)->first();
            $price += $selectSchedule->price;
            // dd($selectedSchedule);
            BookedSchedule::create([
                'booked_id' => $data['booked_id'],
                'schedule_id' => $scheduleID,
                'timeStart' => $selectSchedule->timeStart,
                'timeEnd' => $selectSchedule->timeEnd,
            ]);

            Court::where('id', $court_id)->update(['availability' => 'booked']);
        }

        Transaction::create([
            'user_id' => $user_id,
            'court_id' => $court_id,
            'booked_id' => $data['booked_id'],
            'total' => $price,
            'payment_metode' => $data['payment_metode'],
        ]);

        return redirect('/')->with('successBooking', 'Terima kasih telah melakukan booking lapangan di GOR Purwawidjaya');

        // $schedule = Schedule::where('id', $scheduleID)->update(['availability' => 'booked']);
    }
}
