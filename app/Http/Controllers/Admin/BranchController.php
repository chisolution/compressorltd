<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use Illuminate\Http\Request;

class BranchController extends Controller
{
    /**
     * Display a listing of branches
     */
    public function index()
    {
        $branches = Branch::sorted()->get();
        return view('admin.branches.index', compact('branches'));
    }

    /**
     * Show the form for creating a new branch
     */
    public function create()
    {
        return view('admin.branches.create');
    }

    /**
     * Store a newly created branch
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'nullable|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'manager_name' => 'nullable|string|max:255',
            'operating_hours' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        Branch::create($request->all());

        return redirect()->route('admin.branches.index')
            ->with('success', 'Branch created successfully.');
    }

    /**
     * Display the specified branch
     */
    public function show(Branch $branch)
    {
        return view('admin.branches.show', compact('branch'));
    }

    /**
     * Show the form for editing the specified branch
     */
    public function edit(Branch $branch)
    {
        return view('admin.branches.edit', compact('branch'));
    }

    /**
     * Update the specified branch
     */
    public function update(Request $request, Branch $branch)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'province' => 'nullable|string|max:255',
            'address' => 'required|string',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'manager_name' => 'nullable|string|max:255',
            'operating_hours' => 'nullable|string',
            'latitude' => 'nullable|numeric|between:-90,90',
            'longitude' => 'nullable|numeric|between:-180,180',
            'active' => 'boolean',
            'sort_order' => 'nullable|integer|min:0'
        ]);

        $branch->update($request->all());

        return redirect()->route('admin.branches.index')
            ->with('success', 'Branch updated successfully.');
    }

    /**
     * Remove the specified branch
     */
    public function destroy(Branch $branch)
    {
        $branch->delete();

        return redirect()->route('admin.branches.index')
            ->with('success', 'Branch deleted successfully.');
    }

    /**
     * Toggle branch active status
     */
    public function toggleActive(Branch $branch)
    {
        $branch->update(['active' => !$branch->active]);

        $status = $branch->active ? 'activated' : 'deactivated';
        return redirect()->route('admin.branches.index')
            ->with('success', "Branch {$status} successfully.");
    }
}
