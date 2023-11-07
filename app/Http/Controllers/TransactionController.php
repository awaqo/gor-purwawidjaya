<?php

namespace App\Http\Controllers;

use App\Models\Court;
use App\Models\CourtImages;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
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
        // dd($court);
        $date = date('l');
        return view('customer.transaction.index', compact('weekday', 'court', 'schedules', 'today', 'date'));
    }
}
