<?php

namespace App\Http\Controllers;

use App\Models\DailyExpense;
use App\Models\AccountHeadMaster;
use App\Models\PartyMaster;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DailyExpenseController extends Controller
{
    public function index()
    {
        $expenses = DailyExpense::with(['accountHead', 'party'])
            ->latest()
            ->get();
        // dd($expenses[0]['accountHead']->ac_head_name);
        return view('daily-expense.index', compact('expenses'));
    }

    public function create()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $voucherNo = $this->generateVoucherNo();
        $accountHeads = AccountHeadMaster::get();
        $parties = PartyMaster::all();
        // dd($accountHeads);
        return view('daily-expense.create', compact('currentDate', 'voucherNo', 'accountHeads', 'parties'));
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'date' => 'required|date',
                'voucher_no' => 'required|string|unique:daily_expenses',
                'ac_head_id' => 'required|exists:account_head_master,ac_head_id',
                'party_id' => 'required|exists:party_master,party_id',
                'description' => 'required|string|max:255',
                'amount' => 'required|numeric|min:0',
                'payment_mode' => 'required|string|in:Cash,Bank,UPI,Card,Other',
                'reference_no' => 'nullable|string|max:255',
                'remark' => 'nullable|string'
            ]);
    
            DailyExpense::create($request->all());
    
            return redirect()->route('daily-expenses.index')
                ->with('success', 'Daily expense created successfully.');
        }catch(\Illuminate\Validation\ValidationException $ex){
            dd($ex->errors());
        }
        
    }

    public function edit(DailyExpense $dailyExpense)
    {
        $accountHeads = AccountHeadMaster::all();
        $parties = PartyMaster::all();
        return view('daily-expense.edit', compact('dailyExpense', 'accountHeads', 'parties'));
    }

    public function update(Request $request, DailyExpense $dailyExpense)
    {
        $request->validate([
            'date' => 'required|date',
            'voucher_no' => 'required|string|unique:daily_expenses,voucher_no,' . $dailyExpense->id,
            'ac_head_id' => 'required|exists:account_head_master,ac_head_id',
            'party_id' => 'required|exists:party_master,party_id',
            'description' => 'required|string|max:255',
            'amount' => 'required|numeric|min:0',
            'payment_mode' => 'required|string|in:Cash,Bank,UPI,Card,Other',
            'reference_no' => 'nullable|string|max:255',
            'remark' => 'nullable|string'
        ]);

        $dailyExpense->update($request->all());

        return redirect()->route('daily-expenses.index')
            ->with('success', 'Daily expense updated successfully.');
    }

    public function destroy(DailyExpense $dailyExpense)
    {
        $dailyExpense->delete();

        return redirect()->route('daily-expenses.index')
            ->with('success', 'Daily expense deleted successfully.');
    }

    private function generateVoucherNo()
    {
        $year = Carbon::now()->year;
        $lastExpense = DailyExpense::whereYear('date', $year)
            ->orderBy('voucher_no', 'desc')
            ->first();

        if ($lastExpense) {
            $lastNumber = intval(substr($lastExpense->voucher_no, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $year . $newNumber;
    }
} 