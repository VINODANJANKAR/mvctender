<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Partymaster;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::with(['party'])
        ->latest()
        ->get();
        return view('material.index', compact('materials'));
    }

    public function create()
    {
        $materialCode = $this->generateMaterialCode();
        $parties = PartyMaster::all();
        return view('material.create', compact('materialCode','parties'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'party_id' => 'required|exists:party_master,party_id',
            'entry_no' => 'required|string',
            'entry_date' => 'required|date',
            'challan_no' => 'required|string',
            'challan_date' => 'required|date',
            'material_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'rate' => 'nullable|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'site_code' => 'required|',
            'name_of_work' => 'required|string'
        ]);

        Material::create($request->all());

        return redirect()->route('materials.index')
            ->with('success', 'Material created successfully.');
    }

    public function edit(Material $material)
    {
        $parties = PartyMaster::all();
        return view('material.edit', compact('material','parties'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'party_id' => 'required|exists:party_master,party_id',
            'entry_no' => 'required|string',
            'entry_date' => 'required|date',
            'challan_no' => 'required|string',
            'challan_date' => 'required|date',
            'material_name' => 'required|string|max:255',
            'quantity' => 'required|numeric|min:0',
            'unit' => 'nullable|string|max:50',
            'rate' => 'nullable|numeric|min:0',
            'amount' => 'required|numeric|min:0',
            'site_code' => 'required|',
            'name_of_work' => 'required|string'
        ]);

        $material->update($request->all());

        return redirect()->route('materials.index')
            ->with('success', 'Material updated successfully.');
    }

    public function destroy(Material $material)
    {
        $material->delete();

        return redirect()->route('materials.index')
            ->with('success', 'Material deleted successfully.');
    }

    private function generateMaterialCode()
    {
        $lastMaterial = Material::latest()->first();
        if ($lastMaterial) {
            $lastNumber = intval(substr($lastMaterial->material_code, -4));
            $newNumber = str_pad($lastNumber + 1, 4, '0', STR_PAD_LEFT);
        } else {
            $newNumber = '0001';
        }
        return 'MAT' . $newNumber;
    }
} 