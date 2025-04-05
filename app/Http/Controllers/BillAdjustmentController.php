<?php

namespace App\Http\Controllers;

use App\Models\BillAdjustment;
use App\Models\BillDetail;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BillAdjustmentController extends Controller
{
    public function index()
    {
        $adjustments = BillAdjustment::with('billDetail')
            ->latest()
            ->get();
        return view('bill-adjustment.index', compact('adjustments'));
    }

    public function create()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $voucherNo = $this->generateVoucherNo();
        $bills = BillDetail::with(['workOrder', 'workOrder.department'])
            ->get()
            ->map(function ($bill) {
                return [
                    'id' => $bill->id,
                    'display' => $bill->bill_no . ' - ' . $bill->workOrder->department->department_name . ' - ' . number_format($bill->total_bill_amount, 2)
                ];
            });
        return view('bill-adjustment.create', compact('currentDate', 'voucherNo', 'bills'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'date' => 'required|date',
            'voucher_no' => 'required|string|unique:bill_adjustments',
            'bill_detail_id' => 'required|exists:bill_details,id',
            'adjustment_amount' => 'required|numeric|min:0',
            'adjustment_type' => 'required|in:Addition,Deduction',
            'reason' => 'required|string'
        ]);

        BillAdjustment::create($request->all());

        return redirect()->route('bill-adjustments.index')
            ->with('success', 'Bill adjustment created successfully.');
    }

    public function edit(BillAdjustment $billAdjustment)
    {
        $bills = BillDetail::with(['workOrder', 'workOrder.department'])
            ->get()
            ->map(function ($bill) {
                return [
                    'id' => $bill->id,
                    'display' => $bill->bill_no . ' - ' . $bill->workOrder->department->department_name . ' - ' . number_format($bill->total_bill_amount, 2)
                ];
            });
        return view('bill-adjustment.edit', compact('billAdjustment', 'bills'));
    }

    public function update(Request $request, BillAdjustment $billAdjustment)
    {
        $request->validate([
            'date' => 'required|date',
            'voucher_no' => 'required|string|unique:bill_adjustments,voucher_no,' . $billAdjustment->id,
            'bill_detail_id' => 'required|exists:bill_details,id',
            'adjustment_amount' => 'required|numeric|min:0',
            'adjustment_type' => 'required|in:Addition,Deduction',
            'reason' => 'required|string'
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