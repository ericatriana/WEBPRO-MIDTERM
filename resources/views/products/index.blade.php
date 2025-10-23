@include('layouts.header')

<main class="content">
    <div class="header-row">
        <h3>Product List</h3>
        <a href="{{ route('products.create') }}" class="btn-add">+ Add New Product</a>
    </div>

    <!-- 🔍 Search & Filter Bar -->
    <form method="GET" action="{{ route('products.index') }}" class="filter-bar" style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:20px;">
        <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by product name..." 
               style="flex:2; padding:10px; border:1.5px solid #FFD0C7; border-radius:10px;">

        <select name="supplier" style="flex:1; padding:10px; border:1.5px solid #FFD0C7; border-radius:10px;">
            <option value="">All Suppliers</option>
            @foreach ($suppliers as $supplier)
                <option value="{{ $supplier->id }}" {{ request('supplier') == $supplier->id ? 'selected' : '' }}>
                    {{ $supplier->name }}
                </option>
            @endforeach
        </select>

        <select name="stock_filter" style="flex:1; padding:10px; border:1.5px solid #FFD0C7; border-radius:10px;">
            <option value="">All Stock</option>
            <option value="high" {{ request('stock_filter') == 'high' ? 'selected' : '' }}>Highest Stock</option>
            <option value="low" {{ request('stock_filter') == 'low' ? 'selected' : '' }}>Lowest Stock</option>
        </select>

        <button type="submit" class="btn-primary" style="flex:0.5; padding:10px 20px;">Search</button>
        <a href="{{ route('suppliers.index') }}" class="reset-button" style="flex:0.5; text-align:center;">Reset</a>

    </form>

    <!-- 📋 Product Table -->
    <div class="table-wrapper">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Supplier</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allProducts as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description ?? '-' }}</td>
                    <td>{{ optional($product->supplier)->name ?? '-' }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td style="display:flex; flex-direction:column; gap:5px;">
                        <a href="{{ route('products.show', $product) }}" class="btn-action view">View</a>
                        <a href="{{ route('products.edit', $product) }}" class="btn-action edit">Edit</a>
                        <form action="{{ route('products.destroy', $product) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-action delete" onclick="return confirm('Delete this product?')">Delete</button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="7" style="text-align:center; color:#aaa; padding:20px;">No products found.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

@include('layouts.footer')
