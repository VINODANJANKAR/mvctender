<?php

namespace App\Http\Controllers;

use App\Models\PartnerMaster;
use Illuminate\Http\Request;

class PartnerMasterController extends Controller
{
    public function index()
    {
        $partners = PartnerMaster::latest()->get();
        return view('masters.partner.index', compact('partners'));
    }

    public function create()
    {
        return view('masters.partner.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'partner_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'contact_no' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'gst_no' => 'nullable|string|max:15',
            'pan_no' => 'nullable|string|max:10'
        ]);

        PartnerMaster::create($request->all());

        return redirect()->route('partners.index')
            ->with('success', 'Partner created successfully.');
    }

    public function edit(PartnerMaster $partner)
    {
        return view('masters.partner.edit', compact('partner'));
    }

    public function update(Request $request, PartnerMaster $partner)
    {
        $request->validate([
            'partner_name' => 'required|string|max:255',
            'address' => 'nullable|string',
            'contact_no' => 'nullable|string|max:20',
            'email' => 'nullable|email|max:255',
            'gst_no' => 'nullable|string|max:15',
            'pan_no' => 'nullable|string|max:10'
        ]);

        $partner->update($request->all());

        return redirect()->route('partners.index')
            ->with('success', 'Partner updated successfully.');
    }

    public function destroy(PartnerMaster $partner)
    {
        $partner->delete();

        return redirect()->route('partners.index')
            ->with('success', 'Partner deleted successfully.');
    }
} 