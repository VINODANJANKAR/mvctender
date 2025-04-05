<?php

namespace App\Http\Controllers;

use App\Models\PaymentEntry;
use App\Models\Party;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentEntryController extends Controller
{
    public function index()
    {
        $payments = PaymentEntry::with('party')
            ->latest()
            ->get();
        return view('payment.index', compact('payments'));
    }

    public function create()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $voucherNo = $this->generateVoucherNo();
        $parties = Party::all();
        return view('payment.create', compact('currentDate', 'voucherNo', 'parties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'voucher_no' => 'required|string|unique:payment_entries',
            'party_id' => 'required|exists:parties,party_id',
            'payment_type' => 'required|in:Received,Given',
            'amount' => 'required|numeric|min:0',
            'payment_mode' => 'required|in:Cash,Bank,UPI,Card,Other',
            'reference_no' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        PaymentEntry::create($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Payment entry created successfully.');
    }

    public function edit(PaymentEntry $payment)
    {
        $parties = Party::all();
        return view('payment.edit', compact('payment', 'parties'));
    }

    public function update(Request $request, PaymentEntry $payment)
    {
        $request->validate([
            'date' => 'required|date',
            'voucher_no' => 'required|string|unique:payment_entries,voucher_no,' . $payment->id,
            'party_id' => 'required|exists:parties,party_id',
            'payment_type' => 'required|in:Received,Given',
            'amount' => 'required|numeric|min:0',
            'payment_mode' => 'required|in:Cash,Bank,UPI,Card,Other',
            'reference_no' => 'nullable|string|max:255',
            'description' => 'nullable|string'
        ]);

        $payment->update($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Payment entry updated successfully.');
    }

    public function destroy(PaymentEntry $payment)
    {
        $payment->delete();

        return redirect()->route('payments.index')
            ->with('success', 'Payment entry deleted successfully.');
    }

    private function generateVoucherNo()
    {
        $year = Carbon::now()->year;
        $lastPayment = PaymentEntry::whereYear('date', $year)
            ->orderBy('voucher_no', 'desc')
            ->first();

        if ($lastPayment) {
            $lastNumber = intval(substr($lastPayment->voucher_no, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $year . $newNumber;
    }
} 