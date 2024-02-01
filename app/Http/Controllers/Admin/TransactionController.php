<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Payment;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function getAll()
    {
        $transaction = Transaction::with(['user', 'court'])
            ->orderByDesc('created_at')
            ->paginate(10);
        return view('admin.transaction.index', compact('transaction'));
    }

    public function detailTransaction(string $id)
    {
        $detailTransaction = DB::table('transactions')
            ->join('bookings', 'transactions.booking_id', '=', 'bookings.booking_id')
            ->join('courts', 'courts.id', '=', 'transactions.court_id')
            ->join('users', 'users.id', '=', 'transactions.user_id')
            ->select('transactions.*', 'bookings.booking_name', 'bookings.date', 'courts.court_name', 'users.name')
            ->where('transactions.id', $id)
            ->first();
        
        $dataPayment = Payment::where('transaction_id', $id)->first();

        $BkTime = Booking::get();

        return view('admin.transaction.detail', compact('detailTransaction', 'BkTime', 'dataPayment'));
    }

    public function confirmTransaction(string $id)
    {
        Transaction::where('id', $id)->update([
            'order_status' => 'confirmed'
        ]);

        return redirect()->back()->with('successConfirm', 'Konfirmasi booking berhasil');
    }

    public function endTransaction(string $id)
    {
        Transaction::where('id', $id)->update([
            'order_status' => 'completed'
        ]);

        return redirect()->back()->with('endTransaction', 'Berhasil menyelesaikan transaksi');
    }
}
