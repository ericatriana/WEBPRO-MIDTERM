@extends('layouts.dashboard')

@section('title', 'Dashboard - Inventory Manager')

@section('content')
<div class="dashboard-wrapper">
    <div class="welcome-section">
        <h1>📦 Inventory Dashboard</h1>
        <p>Welcome back! Here's an overview of your warehouse inventory.</p>
    </div>

    {{-- Statistics Cards --}}
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-number">{{ $totalProducts ?? 0 }}</div>
            <div class="stat-label">Total Products</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $totalSuppliers ?? 0 }}</div>
            <div class="stat-label">Total Suppliers</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $lowStock ?? 0 }}</div>
            <div class="stat-label">Low Stock Items</div>
        </div>
        <div class="stat-card">
            <div class="stat-number">{{ $outOfStock ?? 0 }}</div>
            <div class="stat-label">Out of Stock</div>
        </div>
    </div>

    {{-- Products Section --}}
    <div class="welcome-section">
        <h2>📋 Available Products</h2>
        <p>Here's a list of all items currently available in your inventory.</p>
    </div>

    <div class="product-grid">
        @forelse($products ?? [] as $product)
            <div class="product-card">
                <div class="product-info">
                    <h3>{{ $product->name ?? 'N/A' }}</h3>
                    <p class="price">Rp {{ number_format($product->price ?? 0, 0, ',', '.') }}</p>
                    <p class="stock">Stock: {{ $product->stock ?? 0 }} items</p>
                    @if(isset($product->supplier))
                        <div class="supplier-info">
                            Supplier: {{ $product->supplier->name ?? 'Unknown' }}
                        </div>
                    @endif
                </div>
            </div>
        @empty
            <div class="text-center" style="grid-column: 1 / -1;">
                <p>No products available at the moment.</p>
                <a href="{{ route('products.index') }}">
                    Add your first product →
                </a>
            </div>
        @endforelse
    </div>
</div>
@endsection
