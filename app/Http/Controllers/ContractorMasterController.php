<?php

namespace App\Http\Controllers;

use App\Models\ContractorMaster;
use Illuminate\Http\Request;

class ContractorMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $contractors = ContractorMaster::latest()->get();
        return view('masters.contractor.index', compact('contractors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        return view('masters.contractor.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
                'name' => 'required',
                'mobile_number' => 'required|unique:contractor_masters'
            ]);

        $data = array(
            'name' => $request->name,
            'mobile_number'=> $request->mobile_number,
            'address'=> $request->address
        );
        $insert_id = ContractorMaster::insert($data);
        return redirect()->route('contractor.index')
            ->with('success', 'Contractor created successfully.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(ContractorMaster $contractor)
    {
        //
        return view('masters.contractor.edit', compact('contractor'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, ContractorMaster $contractor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|unique:contractor_masters,mobile_number,' . $contractor->id
        ]);
        
        $contractor->update($request->all());
    
        return redirect()->route('contractor.index')
            ->with('success', 'Contractor updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ContractorMaster $contractor)
    {
        //
        $contractor->delete();

        return redirect()->route('contractor.index')
            ->with('success', 'Contractor deleted successfully.');
    }
}
