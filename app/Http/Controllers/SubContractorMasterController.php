<?php

namespace App\Http\Controllers;

use App\Models\SubContractorMaster;
use App\Models\ContractorMaster;
use Illuminate\Http\Request;

class SubContractorMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        // $subcontractors = SubContractorMaster::latest()->get();
        // $contractors = ContractorMaster::latest()->get();
        // return view('masters.sub-contractor.index', compact('subcontractors','contractors'));


        $subcontractors = SubContractorMaster::with('contractor')->latest()->get();
return view('masters.sub-contractor.index', compact('subcontractors'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $contractors = ContractorMaster::latest()->get();
        return view('masters.sub-contractor.create', compact('contractors'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
                'name' => 'required',
                'mobile_number' => 'required|unique:sub_contractor_masters'
            ]);
            // dd($request->all());
        $data = array(
            'name' => $request->name,
            'mobile_number'=> $request->mobile_number,
            'address'=> $request->address,
            'contractor_id' => $request->contractor_id
        );
        $insert_id = SubContractorMaster::insert($data);
        return redirect()->route('subcontractor.index')
            ->with('success', 'Sub Contractor created successfully.');

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
    public function edit(SubContractorMaster $subcontractor)
    {
        //
        $contractors = ContractorMaster::latest()->get();
        return view('masters.sub-contractor.edit', compact('subcontractor','contractors'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SubContractorMaster $subcontractor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mobile_number' => 'required|unique:sub_contractor_masters,mobile_number,' . $subcontractor->id
        ]);
        // dd($request->all());
        $subcontractor->update($request->all());
    
        return redirect()->route('subcontractor.index')
            ->with('success', 'Sub Contractor updated successfully.');
    }
    
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SubContractorMaster $subcontractor)
    {
        //
        $subcontractor->delete();

        return redirect()->route('subcontractor.index')
            ->with('success', 'Contractor deleted successfully.');
    }
}
