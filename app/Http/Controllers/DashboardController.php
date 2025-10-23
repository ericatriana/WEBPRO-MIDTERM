<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Supplier;

class DashboardController extends Controller
{
    public function index()
    {
        $totalProducts = Product::count();
        $outOfStock = Product::where('stock', 0)->count();
        $lowStock = Product::where('stock', '<', 5)->count();
        $totalSuppliers = Supplier::count();

        // Ambil semua produk + supplier
        $products = Product::with('supplier')->get();

        return view('dashboard', [
            'css' => 'dashboard',
            'totalProducts' => $totalProducts,
            'outOfStock' => $outOfStock,
            'lowStock' => $lowStock,
            'totalSuppliers' => $totalSuppliers,
            'products' => $products,
        ]);
    }
}
