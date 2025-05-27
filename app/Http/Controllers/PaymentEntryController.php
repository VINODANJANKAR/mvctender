<?php

namespace App\Http\Controllers;

use App\Models\PaymentEntry;
use App\Models\PartnerMaster;
use App\Models\PartyMaster;
use Illuminate\Http\Request;
use Carbon\Carbon;

class PaymentEntryController extends Controller
{
    public function index()
    {
        $payments = PaymentEntry::with('partner')
            ->latest()
            ->get();
        $parties = PartyMaster::all();
        return view('payment.index', compact('payments', 'parties'));
    }

    public function create()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        // $voucherNo = $this->generateVoucherNo();
        $partners = PartnerMaster::all();
        $parties = PartyMaster::all();
        return view('payment.create', compact('partners', 'parties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'paid_to' => 'required|exists:party_master,party_id',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'gst_amount' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'payment_mode' => 'required|in:Cash,Bank,UPI,Card,Other',
            'beneficiary_name' => 'nullable|string|max:255',
            'partner_id' => 'required|exists:partner_master,partner_id',
            'bank_name' => 'nullable|string|max:255',
            'bank_ac_name' => 'nullable|string|max:255',
            'other_charges' => 'nullable|string|max:255',
            'ref' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:255',
        ]);

        PaymentEntry::create($request->all());

        return redirect()->route('payments.index')
            ->with('success', 'Payment entry created successfully.');
    }

    public function edit(PaymentEntry $payment)
    {
        $partners = PartnerMaster::all();
        $parties = PartyMaster::all();
        return view('payment.edit', compact('payment', 'partners', 'parties'));
    }

    public function update(Request $request, PaymentEntry $payment)
    {
        $request->validate([
            'date' => 'required|date',
            'paid_to' => 'required|exists:party_master,party_id',
            'description' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'gst_amount' => 'required|numeric|min:0',
            'total_amount' => 'required|numeric|min:0',
            'payment_mode' => 'required|in:Cash,Bank,UPI,Card,Other',
            'beneficiary_name' => 'nullable|string|max:255',
            'partner_id' => 'required|exists:partner_master,partner_id',
            'bank_name' => 'nullable|string|max:255',
            'bank_ac_name' => 'nullable|string|max:255',
            'other_charges' => 'nullable|string|max:255',
            'ref' => 'nullable|string|max:255',
            'remarks' => 'nullable|string|max:255',
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