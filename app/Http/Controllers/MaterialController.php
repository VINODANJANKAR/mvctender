<?php

namespace App\Http\Controllers;

use App\Models\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = Material::latest()->get();
        return view('material.index', compact('materials'));
    }

    public function create()
    {
        $materialCode = $this->generateMaterialCode();
        return view('material.create', compact('materialCode'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'material_code' => 'required|string|unique:materials',
            'material_name' => 'required|string|max:255',
            'unit' => 'nullable|string|max:50',
            'rate' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
        ]);

        Material::create($request->all());

        return redirect()->route('materials.index')
            ->with('success', 'Material created successfully.');
    }

    public function edit(Material $material)
    {
        return view('material.edit', compact('material'));
    }

    public function update(Request $request, Material $material)
    {
        $request->validate([
            'material_code' => 'required|string|unique:materials,material_code,' . $material->id,
            'material_name' => 'required|string|max:255',
            'unit' => 'nullable|string|max:50',
            'rate' => 'nullable|numeric|min:0',
            'description' => 'nullable|string',
            'is_active' => 'boolean'
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