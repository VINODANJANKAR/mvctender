<?php

namespace App\Http\Controllers;

use App\Models\AccountHeadMaster;
use Illuminate\Http\Request;

class AccountHeadMasterController extends Controller
{
    public function index()
    {
        $accountHeads = AccountHeadMaster::latest()->get();
        return view('masters.account-head.index', compact('accountHeads'));
    }

    public function create()
    {
        return view('masters.account-head.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'account_head_name' => 'required|string|max:255',
            'account_head_code' => 'required|string|max:50|unique:account_head_masters',
            'description' => 'nullable|string'
        ]);

        AccountHeadMaster::create($request->all());

        return redirect()->route('account-heads.index')
            ->with('success', 'Account Head created successfully.');
    }

    public function edit(AccountHeadMaster $accountHead)
    {
        return view('account-head-master.edit', compact('accountHead'));
    }

    public function update(Request $request, AccountHeadMaster $accountHead)
    {
        $request->validate([
            'account_head_name' => 'required|string|max:255',
            'account_head_code' => 'required|string|max:50|unique:account_head_masters,account_head_code,' . $accountHead->id,
            'description' => 'nullable|string'
        ]);

        $accountHead->update($request->all());

        return redirect()->route('account-heads.index')
            ->with('success', 'Account Head updated successfully.');
    }

    public function destroy(AccountHeadMaster $accountHead)
    {
        $accountHead->delete();

        return redirect()->route('account-heads.index')
            ->with('success', 'Account Head deleted successfully.');
    }
} 