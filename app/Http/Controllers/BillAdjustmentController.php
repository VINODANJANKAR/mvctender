<?php

namespace App\Http\Controllers;

use App\Models\BillAdjustment;
use App\Models\BillDetail;
use App\Models\PartnerMaster;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BillAdjustmentController extends Controller
{
    public function index()
    {
        $adjustments = BillAdjustment::latest()->get();
        return view('bill-adjustment.index', compact('adjustments'));
    }

    public function create()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $voucherNo = $this->generateVoucherNo();
        $partners = PartnerMaster::all();

        return view('bill-adjustment.create', compact('currentDate', 'voucherNo','partners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            "date" => "required",
            // "voucher_no" => "required",
            "bank_name" => "required",
            "account_number" => "required",
            "beneficiary_name" => "required",
            "name_of_ref_person" => "required",
            "paid_by" => "required",
            "rtgs_amt" => "required",
            "commision_rate" => "required",
            "net_amt" => "required",
            "amt_received_from" => "required",
            "amt_recevied_date" => "required",
            "recevied_amount" => "required",
        ]);

        BillAdjustment::create($request->all());

        return redirect()->route('bill-adjustments.index')
            ->with('success', 'Bill adjustment created successfully.');
    }

    public function edit(BillAdjustment $billAdjustment)
    {
        $billAdjustment = BillAdjustment::findOrFail($billAdjustment->id);
        $partners = PartnerMaster::all(); // Fetch partners for 'paid_by
        // dd($billAdjustment);
        return view('bill-adjustment.edit', compact('billAdjustment','partners'));
    }

    public function update(Request $request, BillAdjustment $billAdjustment)
    {
        $request->validate([
            "date" => "required",
            // "voucher_no" => "required",
            "bank_name" => "required",
            "account_number" => "required",
            "beneficiary_name" => "required",
            "name_of_ref_person" => "required",
            "paid_by" => "required",
            "rtgs_amt" => "required",
            "commision_rate" => "required",
            "net_amt" => "required",
            "amt_received_from" => "required",
            "amt_recevied_date" => "required",
            "recevied_amount" => "required",
        ]);

        $billAdjustment->update($request->all());

        return redirect()->route('bill-adjustments.index')
            ->with('success', 'Bill adjustment updated successfully.');
    }

    public function destroy(BillAdjustment $billAdjustment)
    {
        $billAdjustment->delete();

        return redirect()->route('bill-adjustments.index')
            ->with('success', 'Bill adjustment deleted successfully.');
    }

    private function generateVoucherNo()
    {
        $year = Carbon::now()->year;
        $lastAdjustment = BillAdjustment::whereYear('date', $year)
            ->orderBy('voucher_no', 'desc')
            ->first();

        if ($lastAdjustment) {
            $lastNumber = intval(substr($lastAdjustment->voucher_no, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $year . $newNumber;
    }
} 