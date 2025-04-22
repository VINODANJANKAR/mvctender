<?php

namespace App\Http\Controllers;

use App\Models\ContractorMaster;
use App\Models\WorkOrderEntry;
use App\Models\DepartmentMaster;
use App\Models\PartnerMaster;
use App\Models\TenderEntry;
use App\Models\PartyMaster;
use App\Models\SubContractorMaster;
use App\Models\TenderTransactionTbl;
use App\Models\WorkOrderAdditionalSecDeposit;
use App\Models\WorkOrderSecDeposit;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Contracts\Validation\Validator as ValidationValidator;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class WorkOrderEntryController extends Controller
{
    public function index()
    {
        $workOrders = WorkOrderEntry::with(['department', 'tender'])
            ->latest()
            ->get();
        return view('work-order.index', compact('workOrders'));
    }

    public function create()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $currentYear = Carbon::now()->year;
        $entryYear = substr($currentYear, -2) . '-' . substr($currentYear + 1, -2);
        $siteCode = $this->generateSrNo();
        $departments = DepartmentMaster::all();
        $tenders = TenderEntry::all();
        $parties = PartyMaster::all();
        $partners = PartnerMaster::all();
        // $subcontractor = SubContractorMaster::all();
        // dd($siteCode);
        return view('work-order.create', compact(
            'currentDate',
            'entryYear',
            'siteCode',
            'departments',
            'tenders',
            'parties',
            'partners'
        ));
    }

    public function store(Request $request)
    {
    //    dd($request->all());
        // $request->validate([
        //     // 'sr_no' => 'required|string|unique:work_order_entries',
        //     'entry_date' => 'required',
        //     'entry_year' => 'required',
        //     // 'department_id' => 'required',
        //     'tender_id' => 'required',
        //     // 'contractor_id' => 'required',
        //     // 'subcontractor_id' => 'nullable',
        //     'work_done_by' => 'required',
        //     'agreement_no' => 'required',
        //     'work_order_no' => 'required',
        //     'work_order_date' => 'required',
        //     'work_order_amount' => 'required',
        //     'work_time_limit' => 'required',
        //     'dlp_period' => 'required',
        //     'security_deposit' => 'required',
        //     // 'additional_security_deposit' => 'nullable0'
        // ]);

        $validatedData = $request->validate([
            'entry_date' => 'required',
            'entry_year' => 'required',
            'sr_no' => 'required',
            'agreement_no' => 'required',
            'work_order_no' => 'required',
            'work_order_date' => 'required',
            'work_order_amount' => 'required',
            'work_time_limit' => 'required',
            'dlp_period' => 'required',
            'security_deposit_amount' => 'required',
            'additional_security_deposit_amount' => 'nullable',
            'name_of_work' => 'required',
            'work_head' => 'required',
            'work_done_by_id'=> 'required',
            'security_deposit_fdr_no.*' =>'required',
            'security_deposit_fdr_amt.*'=>'required',
            'security_deposit_fdr_bank.*'=>'required',
            'security_deposit_paid_by.*'=>'required',
            'additional_security_deposit_fdr_no.*'=>'required',
            'additional_security_deposit_fdr_amt.*'=>'required',
            'additional_security_deposit_fdr_bank.*'=>'required',
            'additional_security_deposit_paid_by.*'=>'required',
            'bond_amount'=>'required',
            'bond_amount_bank'=>'required',
            'bond_amount_paid_by'=>'required',

        ]);
        
       
        // dd($request->all());
        #WorkOrderEntry::create($request->all());
        $tenderEntryId = DB::table('work_order_entries')->insertGetId([
            'entry_date' =>  $request->entry_date,
            'entry_year' =>  $request->entry_year,
            'sr_no' =>  $request->site_code,
            'tender_id' =>  $request->sr_no,
            'department_id' => $request->department_id,
            'name_of_contractor'=> $request->name_of_contractor,
            'name_of_subcontractor'=> $request->name_of_subcontractor,
            'agreement_no' =>  $request->agreement_no,
            'work_order_no' =>  $request->work_order_no,
            'work_order_date' =>  $request->work_order_date,
            'work_order_amount' =>  $request->work_order_amount,
            'work_time_limit' =>  $request->work_time_limit,
            'dlp_period' =>  $request->dlp_period,
            'security_deposite' =>  $request->security_deposit_amount,
            'additional_security_deposit' =>  $request->additional_security_deposit_amount,
            'name_of_work' =>  $request->name_of_work,
            'work_head' =>  $request->work_head,
            'work_done_by'=>  $request->work_done_by_id,
            'bond_amount'=> $request->bond_amount,
            'bond_amount_bank'=> $request->bond_amount_bank,
            'bond_amount_paid_by'=> $request->bond_amount_paid_by,
        ]);



        foreach ($validatedData['security_deposit_fdr_no'] as $index => $fdrNo) {
            WorkOrderSecDeposit::create([
                'work_order_id' => $tenderEntryId,
                'security_deposit_fdr_no' =>$fdrNo,
                'security_deposit_fdr_amt'=>$validatedData['security_deposit_fdr_amt'][$index],
                'security_deposit_fdr_bank'=>$validatedData['security_deposit_fdr_bank'][$index],
                'security_deposit_paid_by'=>$validatedData['security_deposit_paid_by'][$index],

            ]);


        }
        foreach ($validatedData['additional_security_deposit_fdr_no'] as $index => $fdrNo) {
            WorkOrderAdditionalSecDeposit::create([
                'work_order_id' => $tenderEntryId,
                'additional_security_deposit_fdr_no' =>$fdrNo,
                'additional_security_deposit_fdr_amt'=>$validatedData['additional_security_deposit_fdr_amt'][$index],
                'additional_security_deposit_fdr_bank'=>$validatedData['additional_security_deposit_fdr_bank'][$index],
                'additional_security_deposit_paid_by'=>$validatedData['additional_security_deposit_paid_by'][$index],

            ]);

            
        }        

        return redirect()->route('work-orders.index')
            ->with('success', 'Work Order created successfully.');
    }

    public function edit(WorkOrderEntry $workOrder)
    {
        $departments = DepartmentMaster::all();
        $tenders = TenderEntry::all();
        $parties = PartyMaster::all();
        $partners = PartnerMaster::all();
        // $contractors = ContractorMaster::all();
        // $subcontractors = SubContractorMaster::all();
        $workOrder = WorkOrderEntry::with(['securityDeposite','addSecurityDeposite','tender'])->findOrFail($workOrder->id);
        // dd($workOrder);
        return view('work-order.edit', compact('workOrder', 'departments', 'tenders', 'parties','partners'));
    }

    public function update(Request $request, WorkOrderEntry $workOrder)
    {
        // dd($request->all());
        try{
        $validatedData = $request->validate([
            'entry_date' => 'required',
            'entry_year' => 'required',
            // 'sr_no' => 'required',
            'department_id'=>'required',
            'name_of_contractor'=>'required',
            'name_of_subcontractor'=>'required',
            'agreement_no' => 'required',
            'work_order_no' => 'required',
            'work_order_date' => 'required',
            'work_order_amount' => 'required',
            'work_time_limit' => 'required',
            'dlp_period' => 'required',
            'security_deposit_amount' => 'required',
            'additional_security_deposit_amount' => 'nullable',
            'name_of_work' => 'required',
            'work_head' => 'required',
            'work_done_by_id'=> 'required',
            'security_deposit_fdr_no.*' =>'required',
            'security_deposit_fdr_amt.*'=>'required',
            'security_deposit_fdr_bank.*'=>'required',
            'security_deposit_paid_by.*'=>'required',
            'additional_security_deposit_fdr_no.*'=>'required',
            'additional_security_deposit_fdr_amt.*'=>'required',
            'additional_security_deposit_fdr_bank.*'=>'required',
            'additional_security_deposit_paid_by.*'=>'required',
            'bond_amount'=>'required',
            'bond_amount_bank'=>'required',
            'bond_amount_paid_by'=>'required',

        ]);
        // dd($validatedData);
        $workOrderId = WorkOrderEntry::findOrFail($workOrder->id);
        // dd($workOrderId);
        // $workOrder->update([
        //     'entry_date' => $request->entry_date,
        //     'entry_year' => $request->entry_year,
        //     'sr_no' => $request->sr_no ?? 001,
        //     'tender_id' =>  $request->sr_no,
        //     'agreement_no' => $request->agreement_no,
        //     'department_id' => $request->department_id,
        //     'contractor_id'=> $request->subcontractor_id,
        //     'work_order_no' => $request->work_order_no,
        //     'work_order_date' => $request->work_order_date,
        //     'work_order_amount' => $request->work_order_amount,
        //     'work_time_limit' => $request->work_time_limit,
        //     'dlp_period' => $request->dlp_period,
        //     'security_deposit_amount' => $request->security_deposit_amount,
        //     'additional_security_deposit_amount' => $request->additional_security_deposit_amount,
        //     'name_of_work' => $request->name_of_work,
        //     'work_head' => $request->work_head,
        //     'work_done_by'=> $request->work_done_by_id,
        // ]);

        $updated = $workOrder->update([
            'entry_date' => $request->entry_date,
            'entry_year' => $request->entry_year,
            'entry_date' => Carbon::parse($request->entry_date)->format('Y-m-d'),
            'sr_no' => $workOrder->sr_no ?? 001,
            'tender_id' =>  $workOrder->tender_id,
            'agreement_no' => $request->agreement_no,
            'department_id' => $request->department_id,
            'name_of_contractor'=> $request->name_of_contractor,
            'name_of_subcontractor'=> $request->name_of_subcontractor,
            'work_order_no' => $request->work_order_no,
            'work_order_date' => $request->work_order_date,
            'work_order_amount' => $request->work_order_amount,
            'work_time_limit' => $request->work_time_limit,
            'dlp_period' => $request->dlp_period,
            'security_deposite' => $request->security_deposit_amount,
            'additional_security_deposit' => $request->additional_security_deposit_amount,
            'name_of_work' => $request->name_of_work,
            'work_head' => $request->work_head,
            'work_done_by'=> $request->work_done_by_id,
            'bond_amount' => $request->bond_amount,
            'bond_amount_bank' => $request->bond_amount_bank,
            'bond_amount_paid_by' => $request->bond_amount_paid_by
        ]);
        
        // dd($updated); // Check if `true` or `false`
        

        $workOrder->securityDeposite()->delete();
        $workOrder->addSecurityDeposite()->delete();



        // foreach ($validatedData['security_deposit_fdr_no'] as $index => $fdrNo) {
        //     WorkOrderSecDeposit::create([
        //         'work_order_id' => $workOrder->id,
        //         'security_deposit_fdr_no' =>$fdrNo,
        //         'security_deposit_fdr_amt'=>$validatedData['security_deposit_fdr_amt'][$index],
        //         'security_deposit_fdr_bank'=>$validatedData['security_deposit_fdr_bank'][$index],
        //         'security_deposit_paid_by'=>$validatedData['security_deposit_paid_by'][$index],

        //     ]);


        // }
        // foreach ($validatedData['additional_security_deposit_fdr_no'] as $index => $fdrNo) {
        //     WorkOrderAdditionalSecDeposit::create([
        //         'work_order_id' => $workOrder->id,
        //         'additional_security_deposit_fdr_no' =>$fdrNo,
        //         'additional_security_deposit_fdr_amt'=>$validatedData['additional_security_deposit_fdr_amt'][$index],
        //         'additional_security_deposit_fdr_bank'=>$validatedData['additional_security_deposit_fdr_bank'][$index],
        //         'additional_security_deposit_paid_by'=>$validatedData['additional_security_deposit_paid_by'][$index],

        //     ]);
        // }   
        
        
        foreach ($validatedData['security_deposit_fdr_no'] ?? [] as $index => $fdrNo) {
            WorkOrderSecDeposit::updateOrCreate(
                ['work_order_id' => $workOrder->id, 'security_deposit_fdr_no' => $fdrNo], // Lookup key
                [
                    'security_deposit_fdr_amt' => $validatedData['security_deposit_fdr_amt'][$index],
                    'security_deposit_fdr_bank' => $validatedData['security_deposit_fdr_bank'][$index],
                    'security_deposit_paid_by' => $validatedData['security_deposit_paid_by'][$index],
                ]
            );
        }
        
        foreach ($validatedData['additional_security_deposit_fdr_no'] ?? [] as $index => $fdrNo) {
            WorkOrderAdditionalSecDeposit::updateOrCreate(
                ['work_order_id' => $workOrder->id, 'additional_security_deposit_fdr_no' => $fdrNo], // Lookup key
                [
                    'additional_security_deposit_fdr_amt' => $validatedData['additional_security_deposit_fdr_amt'][$index],
                    'additional_security_deposit_fdr_bank' => $validatedData['additional_security_deposit_fdr_bank'][$index],
                    'additional_security_deposit_paid_by' => $validatedData['additional_security_deposit_paid_by'][$index],
                ]
            );
        }
        

        return redirect()->route('work-orders.index')
            ->with('success', 'Work Order updated successfully.');
    }
    catch(ValidationValidator $v){
        dd($v);

    }
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
                // $lastNumber = intval(substr($lastWorkOrder->sr_no, -4));
                $lastNumber = preg_replace('/[^0-9]/', '', $lastWorkOrder->sr_no);
                $newNumber = 'WO'. str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
            } else {
                $newNumber = 'WO001';
            }

        return $newNumber;
    }

    public function getTenderDetails(Request $request)
    {
        $srNo = $request->query('sr_no');

        if (!$srNo) {
            return response()->json(['message' => 'SR No is required'], 400);
        }

        $workOrder = TenderEntry::where('id', $srNo)->first();
        if (!$workOrder) {
            return response()->json(['message' => 'Work Order not found'], 404);
        }

        return response()->json([
            'department_id' => $workOrder->department_id,
            'name_of_work' => $workOrder->work_description
            // 'name_of_contractor' => $workOrder->name_of_contractor
        ]);
    }


    public function show($id)
    {
        return response()->json(['message' => 'Show method not implemented'], 404);
    }


    public function getContractors(Request $request)
{
    $tenderId  = $request->query('sr_no');

    if (!$tenderId ) {
        return response()->json(['message' => 'SR No is required'], 400);
    }

    // Fetch contractor IDs related to the tender from the transaction table
    $contractorIds = TenderTransactionTbl::where('tender_id', $tenderId)->pluck('contractor_id');

    // Fetch contractor names from the contractormaster table
    $contractors = ContractorMaster::whereIn('id', $contractorIds)->get(['id', 'name']);
    return response()->json(['contractors' => $contractors]);
}

    
} 