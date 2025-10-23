@include('layouts.header')

<main class="content">
    <div class="header-row">
        <h3>Edit Supplier</h3>
        <a href="{{ route('suppliers.index') }}" class="btn-back">← Back to Supplier List</a>
    </div>

    <form action="{{ route('suppliers.update', $supplier) }}" method="POST" class="form-custom">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="{{ old('name', $supplier->name) }}" required>
        </div>

        <div class="form-group">
            <label for="contact">Contact:</label>
            <input type="text" id="contact" name="contact" value="{{ old('contact', $supplier->contact) }}" required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $supplier->email) }}" required>
        </div>

        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" id="address" name="address" value="{{ old('address', $supplier->address) }}" required>
        </div>

    </form>
</main>

@include('layouts.footer')
