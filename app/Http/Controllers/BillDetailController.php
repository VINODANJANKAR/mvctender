<?php

namespace App\Http\Controllers;

use App\Models\BillDetail;
use App\Models\DepartmentMaster;
use App\Models\PartnerMaster;
use App\Models\WorkOrderEntry;
use Illuminate\Http\Request;

class BillDetailController extends Controller
{
    public function index()
    {
        $bills = BillDetail::with(['department', 'subcontractor', 'workDoneBy', 'workOrder'])
            ->latest()
            ->get();
        return view('bill-detail.index', compact('bills'));
    }

    public function create()
    {
        $departments = DepartmentMaster::all();
        $partners = PartnerMaster::all();
        $workOrders = WorkOrderEntry::all();
        $currentYear = date('Y');
        return view('bill-detail.create', compact('departments', 'partners', 'workOrders', 'currentYear'));
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'site_code' => 'required|string',
                'year' => 'required|string',
                'date' => 'required|date',
                'department_id' => 'required|exists:department_master,department_id',
                'contractor_id' => 'required|string',
                'subcontractor_id' => 'nullable|exists:partner_master,partner_id',
                'name_of_work' => 'required|string',
                'name_of_bank' => 'required|string',
                'work_done_by_id' => 'required|exists:partner_master,partner_id',
                'agreement_no' => 'required|string',
                'bill_no' => 'required|string',
                'work_order_amount' => 'required|numeric',
                'work_time_limit' => 'required|string',
                'dlp_period' => 'required|string',
                'total_bill_amount' => 'required|numeric',
                'deduction_amount' => 'required|numeric',
                'net_bill_amount' => 'required|numeric',
                'security_deposit' => 'required|numeric',
                'insurance' => 'required|numeric',
                'gst' => 'required|numeric',
                'surcharge' => 'required|numeric',
                'cess' => 'required|numeric',
                'tds' => 'required|numeric',
                'royalty' => 'required|numeric',
                'fine' => 'required|numeric',
                'other' => 'required|numeric',
                'bank_charges' => 'required|numeric',
                'stamp_duty' => 'required|numeric',
                'options' => 'required|numeric',
                'gram_panchayat_deduction' => 'required|numeric',
                'gram_panchayat_emd' => 'required|numeric',
                'remark' => 'nullable|string'
            ]);
            // dd($request->all());
            BillDetail::create($request->all());
            return redirect()->route('bill-details.index')->with('success', 'Bill Detail created successfully.');
        }catch (\Illuminate\Validation\ValidationException $e) {
            dd($e->errors()); // This will dump all validation errors
        }
        
        
    }

    public function edit(BillDetail $billDetail)
    {
        // $bills = BillDetail::all($billDetail->id);
        // dd($billDetail);
        $departments = DepartmentMaster::all();
        $partners = PartnerMaster::all();
        $workOrders = WorkOrderEntry::all();
        return view('bill-detail.edit', compact('billDetail', 'departments', 'partners', 'workOrders'));
    }

    public function update(Request $request, BillDetail $billDetail)
    {
        try{
            $request->validate([
                'site_code' => 'required|string',
                'year' => 'required|string',
                'date' => 'required|date',
                'department_id' => 'required|exists:department_master,department_id',
                'name_of_contractor' => 'required|string',
                'subcontractor_id' => 'nullable|exists:partner_master,partner_id',
                'name_of_work' => 'required|string',
                'name_of_bank' => 'required|string',
                'work_done_by_id' => 'required|exists:partner_master,partner_id',
                'agreement_no' => 'required|string',
                'bill_no' => 'required|string',
                'work_order_amount' => 'required|numeric',
                'work_time_limit' => 'required|string',
                'dlp_period' => 'required|string',
                'total_bill_amount' => 'required|numeric',
                'deduction_amount' => 'required|numeric',
                'net_bill_amount' => 'required|numeric',
                'security_deposit' => 'required|numeric',
                'insurance' => 'required|numeric',
                'gst' => 'required|numeric',
                'surcharge' => 'required|numeric',
                'cess' => 'required|numeric',
                'tds' => 'required|numeric',
                'royalty' => 'required|numeric',
                'fine' => 'required|numeric',
                'other' => 'required|numeric',
                'bank_charges' => 'required|numeric',
                'stamp_duty' => 'required|numeric',
                'options' => 'required|numeric',
                'gram_panchayat_deduction' => 'required|numeric',
                'gram_panchayat_emd' => 'required|numeric',
                'remark' => 'nullable|string'
            ]);
    
            $billDetail->update($request->all());
            return redirect()->route('bill-details.index')
                ->with('success', 'Bill Detail updated successfully.');
        }catch(\Illuminate\Validation\ValidationException $e){
            dd($e->errors());
        }
    }

    public function destroy(BillDetail $billDetail)
    {
        $billDetail->delete();
        return redirect()->route('bill-details.index')
            ->with('success', 'Bill Detail deleted successfully.');
    }

    // public function getWorkOrderDetails(Request $request)
    // {
    //     $workOrder = WorkOrderEntry::where('site_code', $request->site_code)->first();
    //     if ($workOrder) {
    //         return response()->json([
    //             'department_id' => $workOrder->department_id,
    //             'name_of_work' => $workOrder->name_of_work,
    //             'name_of_contractor' => $workOrder->name_of_contractor,
    //             'work_order_amount' => $workOrder->work_order_amount,
    //             'work_time_limit' => $workOrder->work_time_limit,
    //             'dlp_period' => $workOrder->dlp_period
    //         ]);
    //     }
    //     return response()->json(null);
    // }
} 