<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use App\Models\Transaction;
use App\Models\Maps;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index($id)
    {
        $transaction = Transaction::where('id', $id)->get();
        $transactionID = $id;
        $maps = Maps::get()->first();
        return view('customer.riwayat.upload-payment', compact('transactionID', 'transaction', 'maps'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function storePayment(Request $request, $id)
    {
        $data = $request->all();
        $data['transaction_id'] = $id;

        if ($request->file('buktiPembayaran')) {
            $extension = $request->file('buktiPembayaran')->getClientOriginalExtension();
            $newName = substr($data['transaction_id'], 24) . '-' . now()->timestamp . '.' . $extension;

            $image = $request->file('buktiPembayaran')->storeAs('assets/payment', $newName, 'public');
        }

        Payment::create([
            'transaction_id' => $id,
            'payment_image' => $image,
            'pay_amount' => $data['pay_amount']
        ]);

        Transaction::where('id', $id)->update([
            'payment_status' => 'paid',
            'order_status' => 'need_confirm'
        ]);

        return redirect('/riwayat-pesanan')->with('successUp', 'Terima kasih sudah mengirim bukti pembayaran');
    }
}
