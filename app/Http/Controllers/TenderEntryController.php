<?php

namespace App\Http\Controllers;

use App\Models\ContractorMaster;
use App\Models\TenderEntry;
use App\Models\DepartmentMaster;
use App\Models\PartnerMaster;
use App\Models\PartyMaster;
use App\Models\TenderTransactionTbl;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Catch_;

class TenderEntryController extends Controller
{
    public function index()
    {
        $tenders = TenderEntry::with('department')->latest()->get();
        return view('tender.index', compact('tenders'));
    }

    public function create()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $tenderNo = $this->generateTenderNo();
        $departments = DepartmentMaster::all();
        // $contractors = ContractorMaster::all();
        $parties = PartyMaster::where('party_type','Contractor')->get();
        $partners = PartnerMaster::all();
        return view('tender.create', compact('currentDate', 'tenderNo', 'departments', 'partners', 'parties'));
    }

    public function store(Request $request)
    {
        try{
            $validatedData = $request->validate([
            'department_id' => 'required',
            'name_of_work' => 'required',
            'tender_id' => 'required',
            'tender_amount' => 'required|numeric',
            'contractor_id.*' => 'required',
            'tender_fee.*' => 'required|numeric',
            'emd_amount.*' => 'required|numeric',
            'paid_by.*' => 'required',
            'emd_amount_refund.*'=> 'nullable',
            'work_order_amount' => 'nullable|numeric',
            'work_time_limit' => 'nullable',
            'days_months' => 'nullable',
            'dlp_period' => 'nullable',
            'work_order_received' => 'nullable|boolean',
        ]);

        $tenderEntryId = DB::table('tender_entries')->insertGetId([
            "tender_no" => $request->sr_no,
            "entry_date" => $request->entry_date,
            "entry_year" => $request->entry_year,
            "department_id" => $request->department_id,
            "work_description" => $request->name_of_work,
            "tender_id" => $request->tender_id,
            "tender_amount" => $request->tender_amount,
            "work_order_amount" => $request->work_order_amount,
            'work_time_limit' => Carbon::parse($request->work_time_limit)->format('Y-m-d'),
            'days_months' => $request->days_months,
            'dlp_period' => $request->dlp_period,
            'work_order_received' => $request->work_order_received,
        ]);

        
        // Store contractor details
        foreach ($validatedData['contractor_id'] as $index => $contractorId) {
            TenderTransactionTbl::create([
                'tender_id' =>$tenderEntryId,
                'contractor_id' => $contractorId,
                'tender_fee' => $validatedData['tender_fee'][$index],
                'emd_amount' => $validatedData['emd_amount'][$index],
                'paid_by' => $validatedData['paid_by'][$index],
                'emd_amount_refund' => $validatedData['emd_amount_refund'][$index],
            ]);
        }

        return redirect()->route('tenders.index')
            ->with('success', 'Tender created successfully.');
        }catch (Exception $e) {
            // Log the error with context
            Log::error('Error Adding tender entry', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        
            // Optionally, return an error response
            return back()->with('error', 'An error occurred while updating the tender. Please try again.');
        }
        }

    public function edit(TenderEntry $tender)
    {

        try {
            $tender = TenderEntry::with('transactions')->findOrFail($tender->id); // Include related contractors
            // dd($tender);
            $departments = DepartmentMaster::all();
            // $contractors = ContractorMaster::all(); // Fetch contractors for dropdowns
            $parties = PartyMaster::where('party_type','Contractor')->get();
            $partners = PartnerMaster::all(); // Fetch partners for 'paid_by
            return view('tender.edit', compact('tender', 'departments', 'partners', 'parties'));
        } catch (Exception $e) {
            //
            Log::error('Error Edit tender entry', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        
            // Optionally, return an error response
            return back()->with('error', 'An error occurred while updating the tender. Please try again.');
        }
    }

    public function update(Request $request, TenderEntry $tender)
    {
// dd($request->all());
        try{
        $validatedData = $request->validate([
            'department_id' => 'required',
            'name_of_work' => 'required',
            'tender_id' => 'required',
            'tender_amount' => 'required|numeric',
            'contractor_id.*' => 'required',
            'tender_fee.*' => 'required|numeric',
            'emd_amount.*' => 'required|numeric',
            'paid_by.*' => 'required',
            'emd_amount_refund.*'=> 'nullable',
            'work_order_amount' => 'nullable|numeric',
            'work_time_limit' => 'nullable',
            'days_months' => 'nullable',
            'dlp_period' => 'nullable',
            'work_order_received' => 'nullable|boolean',
        ]);
        // tender_id
        // $tender->update($request->tender_id);
        $tender = TenderEntry::findOrFail($tender->id);
        // dd($request->tender_id);

        $tender->update([
            "tender_no" => $tender->tender_no,
            "entry_date" => $request->entry_date,
            "entry_year" => $request->entry_year,
            "department_id" => $request->department_id,
            "work_description" => $request->name_of_work,
            "tender_id" => $request->tender_id,
            "tender_amount" => $request->tender_amount,
            "work_order_amount" => $request->work_order_amount,
            'work_time_limit' => Carbon::parse($request->work_time_limit)->format('Y-m-d'),
            'days_months' => $request->days_months,
            'dlp_period' => $request->dlp_period,
            'work_order_received' => $request->work_order_received,
        ]);
       
        $tender->transactions()->delete();

        foreach ($validatedData['contractor_id'] as $index => $contractorId) {
            TenderTransactionTbl::create([
                'tender_id' => $tender->id,
                'contractor_id' => $contractorId,
                'tender_fee' => $validatedData['tender_fee'][$index],
                'emd_amount' => $validatedData['emd_amount'][$index],
                'paid_by' => $validatedData['paid_by'][$index],
                'emd_amount_refund' => $validatedData['emd_amount_refund'][$index],
            ]);
        }

        
        return redirect()->route('tenders.index')
            ->with('success', 'Tender updated successfully.');
        }catch (Exception $e) {
            // Log the error with context
            Log::error('Error updating tender entry', [
                'error_message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);
        
            // Optionally, return an error response
            return back()->with('error', 'An error occurred while updating the tender. Please try again.');
        }
        }

    public function destroy(TenderEntry $tender)
    {
        $tender = TenderEntry::findOrFail($tender->id);
        $tender->transactions()->delete(); // Delete related transactions
        $tender->delete(); // Delete tender itself

        return redirect()->route('tenders.index')
            ->with('success', 'Tender deleted successfully.');
    }

    private function generateTenderNo()
    {
        // $year = Carbon::now()->year;
        $lastTender = TenderEntry::select('tender_no')
            ->orderBy('tender_no', 'desc')
            ->first();

        if ($lastTender) {
            // $lastNumber = intval(substr($lastTender->tender_no, -4));
            $lastNumber = preg_replace('/[^0-9]/', '', $lastTender->tender_no);
            $newNumber = 'TO'.str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = 'TO001';
        }

        return $newNumber;
    }
}
