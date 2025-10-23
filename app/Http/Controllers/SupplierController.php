<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Supplier::query();

        // 🔍 Filter pencarian berdasarkan nama atau email
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // 🔢 Sortir berdasarkan nama
        if ($request->filled('sort')) {
            $sort = $request->input('sort');
            if (in_array($sort, ['asc', 'desc'])) {
                $query->orderBy('name', $sort);
            }
        } else {
            // Default: urut dari terbaru
            $query->orderBy('id', 'desc');
        }

        // Ambil semua supplier
        $allSuppliers = $query->get();

        return view('suppliers.index', compact('allSuppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255|unique:suppliers,contact',
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
        ]);

        Supplier::create($validatedData);

        return redirect()
            ->route('suppliers.index')
            ->with('success', '✅ Supplier created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Supplier $supplier)
    {
        return view('suppliers.show', compact('supplier'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Supplier $supplier)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'contact' => 'required|string|max:255|unique:suppliers,contact,' . $supplier->id,
            'email' => 'required|email|max:255',
            'address' => 'required|string|max:500',
        ]);

        $supplier->update($validatedData);

        return redirect()
            ->route('suppliers.index')
            ->with('success', '✅ Supplier updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Supplier $supplier)
    {
        $supplier->delete();

        return redirect()
            ->route('suppliers.index')
            ->with('success', '🗑️ Supplier deleted successfully.');
    }
}
