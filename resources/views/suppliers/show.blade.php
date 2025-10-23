@include('layouts.header')

<main class="content">
    <div class="header-row">
        <h3>Supplier Details</h3>
        <a href="{{ route('suppliers.index') }}" class="btn-back">← Back to Supplier List</a>
    </div>

    <table class="table-custom">
        <tr><th>ID</th><td>{{ $supplier->id }}</td></tr>
        <tr><th>Name</th><td>{{ $supplier->name }}</td></tr>
        <tr><th>Contact</th><td>{{ $supplier->contact }}</td></tr>
        <tr><th>Email</th><td>{{ $supplier->email ?? '-' }}</td></tr>
        <tr><th>Address</th><td>{{ $supplier->address ?? '-' }}</td></tr>
    </table>

</main>

@include('layouts.footer')
