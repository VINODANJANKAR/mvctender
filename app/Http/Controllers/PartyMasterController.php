<?php

namespace App\Http\Controllers;

use App\Models\PartyMaster;
use Illuminate\Http\Request;

class PartyMasterController extends Controller
{
    public function index()
    {
        $parties = PartyMaster::latest()->get();
        // dd($parties);
        return view('masters.party.index', compact('parties'));
    }

    public function create()
    {
        return view('masters.party.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'party_name' => 'required|string|max:255',
            'party_type' => 'required|string|max:50',
            'address' => 'nullable|string',
            'contact_no' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'gst_number' => 'nullable|string|max:15',
            'pan_no' => 'nullable|string|max:10'
        ]);

        PartyMaster::create($request->all());

        return redirect()->route('parties.index')
            ->with('success', 'Party created successfully.');
    }

    public function edit(PartyMaster $party)
    {
        return view('masters.party.edit', compact('party'));
    }

    public function update(Request $request, PartyMaster $party)
    {
        $request->validate([
            'party_name' => 'required|string|max:255',
            'party_type' => 'required|string|max:50',
            'address' => 'nullable|string',
            'contact_no' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'gst_no' => 'nullable|string|max:15',
            'pan_no' => 'nullable|string|max:10'
        ]);

        $party->update($request->all());

        return redirect()->route('parties.index')
            ->with('success', 'Party updated successfully.');
    }

    public function destroy(PartyMaster $party)
    {
        $party->delete();

        return redirect()->route('parties.index')
            ->with('success', 'Party deleted successfully.');
    }
} 