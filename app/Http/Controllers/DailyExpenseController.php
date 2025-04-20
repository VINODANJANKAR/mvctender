<?php

namespace App\Http\Controllers;

use App\Models\DailyExpense;
use App\Models\AccountHeadMaster;
use App\Models\PartnerMaster;
use Illuminate\Http\Request;
use Carbon\Carbon;

class DailyExpenseController extends Controller
{
    public function index()
    {
        $expenses = DailyExpense::with([ 'partner'])
            ->latest()
            ->get();
        // dd($expenses[0]['accountHead']->ac_head_name);
        return view('daily-expense.index', compact('expenses'));
    }

    public function create()
    {
        $currentDate = Carbon::now()->format('Y-m-d');
        $voucherNo = $this->generateVoucherNo();
        $partners = PartnerMaster::all();
        // dd($accountHeads);
        return view('daily-expense.create', compact('currentDate', 'voucherNo', 'partners'));
    }

    public function store(Request $request)
    {
        try{
            $request->validate([
                'entry_no' => 'required|string|unique:daily_expenses',
                'entry_date' => 'required|date',
                'expense_date' => 'required|date',
                'site_code' => 'nullable|string|max:255',
                'name_of_work' => 'nullable|string|max:255',
                'description' => 'required|string|max:255',
                'paid_to' => 'nullable|string|max:255',
                'payment_through' => 'nullable|string|max:255',
                'amount' => 'required|numeric|min:0',
                'payment_mode' => 'required|string|in:Cash,Bank,UPI,Card,Other',
                'paid_by' => 'required|exists:partner_master,partner_id'
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
        $partners = PartnerMaster::all();
        return view('daily-expense.edit', compact('dailyExpense', 'partners'));
    }

    public function update(Request $request, DailyExpense $dailyExpense)
    {
        $request->validate([
            'entry_no' => 'required|string|unique:daily_expenses,entry_no,' . $dailyExpense->id,
            'entry_date' => 'required|date',
            'expense_date' => 'required|date',
            'site_code' => 'nullable|string|max:255',
            'name_of_work' => 'nullable|string|max:255',
            'description' => 'required|string|max:255',
            'paid_to' => 'nullable|string|max:255',
            'payment_through' => 'nullable|string|max:255',
            'amount' => 'required|numeric|min:0',
            'payment_mode' => 'required|string|in:Cash,Bank,UPI,Card,Other',
            'paid_by' => 'required|exists:partner_master,partner_id'
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
        $lastExpense = DailyExpense::whereYear('entry_date', $year)
            ->orderBy('entry_no', 'desc')
            ->first();

        if ($lastExpense) {
            $lastNumber = intval(substr($lastExpense->entry_no, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }

        return $year . $newNumber;
    }
} 