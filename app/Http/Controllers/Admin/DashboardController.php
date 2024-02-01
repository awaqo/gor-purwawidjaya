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
        $currentMonth = date('m');
        $currentYear = date('Y');

        $court = Court::get();
        $transaction = Transaction::get();

        $needConfirm = Transaction::where('payment_status', 'paid')
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

        $monthlyIncome = Transaction::where('payment_status', 'paid')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('total');

        return view('admin.dashboard.index', compact('court', 'transaction', 'inTransaction', 'confirmTransaction', 'needConfirm', 'monthlyIncome', 'currentMonth'));
    }
}
