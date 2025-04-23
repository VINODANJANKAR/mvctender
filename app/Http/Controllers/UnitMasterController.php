<?php

namespace App\Http\Controllers;

use App\Models\UnitMaster;
use Illuminate\Http\Request;

class UnitMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = UnitMaster::latest()->get();
        // dd($units);
        return view('masters.unit.index', compact('units'));
    }

    public function create()
    {
        return view('masters.unit.create');
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            'unit_name' => 'required|string|max:255'
        ]);

        UnitMaster::create($request->all());

        return redirect()->route('units.index')
            ->with('success', 'Unit Added successfully.');
    }

    public function edit(UnitMaster $unit)
    {
        return view('masters.unit.edit', compact('unit'));
    }

    public function update(Request $request, UnitMaster $unit)
    {
        $request->validate([
            'unit_name' => 'required|string|max:255',
            // 'account_head_code' => 'required|string|max:50|unique:account_head_masters,account_head_code,' . $accountHead->id,
            // 'description' => 'nullable|string'
        ]);

        $unit->update($request->all());

        return redirect()->route('units.index')
            ->with('success', 'Unit updated successfully.');
    }

    public function destroy(UnitMaster $unit)
    {
        $unit->delete();

        return redirect()->route('units.index')
            ->with('success', 'Unit deleted successfully.');
    }
} 