@include('layouts.header')

<main class="content">
    <div class="header-row">
        <h3>Product Details</h3>
        <a href="{{ route('products.index') }}" class="btn-back">← Back to Product List</a>
    </div>

    <table class="table-custom">
        <tr><th>ID</th><td>{{ $product->id }}</td></tr>
        <tr><th>Name</th><td>{{ $product->name }}</td></tr>
        <tr><th>Description</th><td>{{ $product->description ?? '-' }}</td></tr>
        <tr><th>Supplier</th><td>{{ optional($product->supplier)->name ?? '-' }}</td></tr>
        <tr><th>Price</th><td>Rp {{ number_format($product->price, 0, ',', '.') }}</td></tr>
        <tr><th>Stock</th><td>{{ $product->stock }}</td></tr>
        <tr>
        </tr>
    </table>

</main>

@include('layouts.footer')
