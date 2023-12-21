<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transaction::with(['user', 'court'])->get();
        return view('admin.transaction.index', compact('transaction'));
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
        $data = DB::table('transactions')
        ->join('bookings', 'transactions.booking_id', '=', 'bookings.booking_id')
        ->join('schedules', 'schedules.id', '=', 'bookings.schedule_id')
        ->join('courts', 'courts.id', '=', 'transactions.court_id')
        ->join('users', 'users.id', '=', 'transactions.user_id')
        ->select('transactions.*', 'transactions.id as transaction_id', 'bookings.*', 'bookings.id as bk_id', 'schedules.*', 'courts.*', 'users.*')
        ->where('transactions.id', $id)
        ->get();

        return view('admin.transaction.detail', compact('data'));
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
