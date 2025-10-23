@extends('layouts.app')

@section('title', 'Dashboard - Available Products')

@section('content')
<div class="dashboard-wrapper">
    <div class="welcome-section">
        <h1>📦 Available Products</h1>
        <p>Here’s a list of all items currently available in your inventory.</p>
    </div>

    {{-- 🔹 Product Display --}}
    <div class="product-grid">
        @forelse($products as $product)
            <div class="product-card" style="padding: 20px;">
                <div class="product-info">
                    <h3>{{ $product->name }}</h3>
                    <p class="price">Rp {{ number_format($product->price, 0, ',', '.') }}</p>
                    <p class="stock">Stock: {{ $product->stock }}</p>
                </div>
            </div>
        @empty
            <p class="text-center">No products available at the moment.</p>
        @endforelse
    </div>
</div>
@endsection
