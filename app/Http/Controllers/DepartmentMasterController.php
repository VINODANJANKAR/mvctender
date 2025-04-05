<?php

namespace App\Http\Controllers;

use App\Models\DepartmentMaster;
use Illuminate\Http\Request;

class DepartmentMasterController extends Controller
{
    public function index()
    {
        $departments = DepartmentMaster::all();
        return view('masters.department.index', compact('departments'));
    }

    public function create()
    {
        return view('masters.department.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'department_name' => 'required|string|max:100'
        ]);

        DepartmentMaster::create($request->all());
        return redirect()->route('departments.index')->with('success', 'Department created successfully');
    }

    public function edit(DepartmentMaster $department)
    {
        return view('masters.department.edit', compact('department'));
    }

    public function update(Request $request, DepartmentMaster $department)
    {
        $request->validate([
            'department_name' => 'required|string|max:100'
        ]);

        $department->update($request->all());
        return redirect()->route('departments.index')->with('success', 'Department updated successfully');
    }

    public function destroy(DepartmentMaster $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully');
    }
} 