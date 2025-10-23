@include('layouts.header')

<main class="content">
    <div class="form-wrapper">
        <h2>➕ Add New Product</h2>

        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="form-group">
                <label for="name">Product Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter product name" required>
            </div>

            <div class="form-group">
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3" placeholder="Enter product description">{{ old('description') }}</textarea>
            </div>

            <div class="form-group">
                <label for="price">Price (Rp)</label>
                <input type="number" id="price" name="price" step="0.01" value="{{ old('price') }}" placeholder="Enter product price" required>
            </div>

            <div class="form-group">
                <label for="stock">Stock</label>
                <input type="number" id="stock" name="stock" value="{{ old('stock', 0) }}" min="0" placeholder="Enter stock quantity" required>
            </div>

            <div class="form-group">
                <label for="supplier_id">Supplier</label>
                <select id="supplier_id" name="supplier_id" required>
                    <option value="">-- Select Supplier --</option>
                    @foreach($suppliers as $supplier)
                        <option value="{{ $supplier->id }}" {{ old('supplier_id') == $supplier->id ? 'selected' : '' }}>
                            {{ $supplier->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">💾 Save Product</button>
                <a href="{{ route('products.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</main>

@include('layouts.footer')
