<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Court;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::where('role', 'User')->get();
        $court = Court::get();
        $transaction = Transaction::get();
        $confirmTrans = Transaction::where('payment_status', 'paid')
            ->where('order_status', 'need_confirm')
            ->count();

        $inTransaction = Transaction::with(['user', 'court'])
            ->where('order_status', 'awaiting_payment')
            ->orderByDesc('created_at')
            ->get();

        $confirmTransaction = Transaction::with(['user', 'court'])
        ->where('order_status', 'need_confirm')
        ->orderBy('created_at')
        ->get();

        return view('admin.dashboard.index', compact('user', 'court', 'transaction', 'inTransaction', 'confirmTransaction', 'confirmTrans'));
    }
}
