@include('layouts.header')

<main class="content">
    <div class="header-row">
        <h3>Edit Product</h3>
        <a href="{{ route('products.index') }}" class="btn-back">← Back to Product List</a>
    </div>

    <form action="{{ route('products.update', $product) }}" method="POST" enctype="multipart/form-data" class="form-custom">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label>Name:</label>
            <input type="text" name="name" value="{{ old('name', $product->name) }}" required>
        </div>

        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" rows="3">{{ old('description', $product->description) }}</textarea>
        </div>

        <div class="form-group">
            <label>Price (Rp):</label>
            <input type="number" name="price" step="0.01" value="{{ old('price', $product->price) }}" required>
        </div>

        <div class="form-group">
            <label>Stock:</label>
            <input type="number" name="stock" value="{{ old('stock', $product->stock) }}" min="0" required>
        </div>

        <div class="form-group">
            <label>Supplier:</label>
            <select name="supplier_id" required>
                <option value="">-- Select Supplier --</option>
                @foreach($suppliers as $supplier)
                    <option value="{{ $supplier->id }}" {{ old('supplier_id', $product->supplier_id) == $supplier->id ? 'selected' : '' }}>
                        {{ $supplier->name }}
                    </option>
                @endforeach
            </select>
        </div>
    </form>
</main>


@include('layouts.footer')
