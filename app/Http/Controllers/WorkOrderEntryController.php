<?php

namespace App\Http\Controllers;

use App\Models\WorkOrderEntry;
use App\Models\DepartmentMaster;
use App\Models\TenderEntry;
use App\Models\PartyMaster;
use Illuminate\Http\Request;
use Carbon\Carbon;

class WorkOrderEntryController extends Controller
{
    public function index()
    {
        $workOrders = WorkOrderEntry::with(['department', 'tender', 'contractor', 'subcontractor'])
            ->latest()
            ->get();
        return view('work-order.index', compact('workOrders'));
    }

    public function create()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentYear = Carbon::now()->year;
        $entryYear = substr($currentYear, -2) . '-' . substr($currentYear + 1, -2);
        $srNo = $this->generateSrNo();
        
        $departments = DepartmentMaster::all();
        $tenders = TenderEntry::all();
        $parties = PartyMaster::all();
        
        return view('work-order.create', compact(
            'currentDate',
            'entryYear',
            'srNo',
            'departments',
            'tenders',
            'parties'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'sr_no' => 'required|string|unique:work_order_entries',
            'entry_date' => 'required|date',
            'entry_year' => 'required|string',
            'department_id' => 'required|exists:department_masters,id',
            'tender_id' => 'required|exists:tender_entries,id',
            'contractor_id' => 'required|exists:party_masters,id',
            'subcontractor_id' => 'nullable|exists:party_masters,id',
            'work_done_by' => 'required|string',
            'agreement_no' => 'required|string',
            'work_order_no' => 'required|string',
            'work_order_date' => 'required|date',
            'work_order_amount' => 'required|numeric|min:0',
            'work_time_limit' => 'required|string',
            'dlp_period' => 'required|string',
            'security_deposit' => 'required|numeric|min:0',
            'additional_security_deposit' => 'nullable|numeric|min:0'
        ]);

        WorkOrderEntry::create($request->all());

        return redirect()->route('work-orders.index')
            ->with('success', 'Work Order created successfully.');
    }

    public function edit(WorkOrderEntry $workOrder)
    {
        $departments = DepartmentMaster::all();
        $tenders = TenderEntry::all();
        $parties = PartyMaster::all();
        
        return view('work-order.edit', compact('workOrder', 'departments', 'tenders', 'parties'));
    }

    public function update(Request $request, WorkOrderEntry $workOrder)
    {
        $request->validate([
            'sr_no' => 'required|string|unique:work_order_entries,sr_no,' . $workOrder->id,
            'entry_date' => 'required|date',
            'entry_year' => 'required|string',
            'department_id' => 'required|exists:department_masters,id',
            'tender_id' => 'required|exists:tender_entries,id',
            'contractor_id' => 'required|exists:party_masters,id',
            'subcontractor_id' => 'nullable|exists:party_masters,id',
            'work_done_by' => 'required|string',
            'agreement_no' => 'required|string',
            'work_order_no' => 'required|string',
            'work_order_date' => 'required|date',
            'work_order_amount' => 'required|numeric|min:0',
            'work_time_limit' => 'required|string',
            'dlp_period' => 'required|string',
            'security_deposit' => 'required|numeric|min:0',
            'additional_security_deposit' => 'nullable|numeric|min:0'
        ]);

        $workOrder->update($request->all());

        return redirect()->route('work-orders.index')
            ->with('success', 'Work Order updated successfully.');
    }

    public function destroy(WorkOrderEntry $workOrder)
    {
        $workOrder->delete();

        return redirect()->route('work-orders.index')
            ->with('success', 'Work Order deleted successfully.');
    }

    private function generateSrNo()
    {
        $year = Carbon::now()->year;
        $lastWorkOrder = WorkOrderEntry::whereYear('entry_date', $year)
            ->orderBy('sr_no', 'desc')
            ->first();

        if ($lastWorkOrder) {
            $lastNumber = intval(substr($lastWorkOrder->sr_no, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $year . $newNumber;
    }
} 