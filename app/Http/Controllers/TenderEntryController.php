<?php

namespace App\Http\Controllers;

use App\Models\TenderEntry;
use App\Models\DepartmentMaster;
use App\Models\PartnerMaster;
use Illuminate\Http\Request;
use Carbon\Carbon;

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
        $partners = PartnerMaster::all();
        return view('tender.create', compact('currentDate', 'tenderNo', 'departments', 'partners'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tender_no' => 'required|string|unique:tender_entries',
            'tender_date' => 'required|date',
            'department_id' => 'required|exists:department_masters,id',
            'work_description' => 'required|string',
            'estimated_cost' => 'required|numeric|min:0',
            'security_deposit' => 'required|numeric|min:0',
            'tender_opening_date' => 'required|date',
            'tender_closing_date' => 'required|date|after:tender_opening_date',
            'remarks' => 'nullable|string'
        ]);

        TenderEntry::create($request->all());

        return redirect()->route('tenders.index')
            ->with('success', 'Tender created successfully.');
    }

    public function edit(TenderEntry $tender)
    {
        $departments = DepartmentMaster::all();
        return view('tender.edit', compact('tender', 'departments'));
    }

    public function update(Request $request, TenderEntry $tender)
    {
        $request->validate([
            'tender_no' => 'required|string|unique:tender_entries,tender_no,' . $tender->id,
            'tender_date' => 'required|date',
            'department_id' => 'required|exists:department_masters,id',
            'work_description' => 'required|string',
            'estimated_cost' => 'required|numeric|min:0',
            'security_deposit' => 'required|numeric|min:0',
            'tender_opening_date' => 'required|date',
            'tender_closing_date' => 'required|date|after:tender_opening_date',
            'remarks' => 'nullable|string'
        ]);

        $tender->update($request->all());

        return redirect()->route('tenders.index')
            ->with('success', 'Tender updated successfully.');
    }

    public function destroy(TenderEntry $tender)
    {
        $tender->delete();

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
            $lastNumber = intval(substr($lastTender->tender_no, -4));
            $newNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '001';
        }

        return $newNumber;
    }
    
} 