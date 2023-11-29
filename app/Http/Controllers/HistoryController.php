<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class HistoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $transaction = Transaction::where('user_id', auth()->id())
            ->with('booking')
            ->with('court')
            ->orderByDesc('created_at')
            ->paginate(5);
        $payment = Payment::whereIn('transaction_id', $transaction->pluck('id'))->get();
        $user = User::where('id', auth()->id())->first();

        return view('customer.riwayat.index', compact('transaction', 'payment', 'user'));
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
