@include('layouts.header')

<main class="content">
    <div class="form-wrapper">
        <h2>🏢 Add New Supplier</h2>

        <form action="{{ route('suppliers.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="name">Supplier Name</label>
                <input type="text" id="name" name="name" value="{{ old('name') }}" placeholder="Enter supplier name" required>
            </div>

            <div class="form-group">
                <label for="contact">Contact</label>
                <input type="text" id="contact" name="contact" value="{{ old('contact') }}" placeholder="Enter contact number" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="{{ old('email') }}" placeholder="Enter email address" required>
            </div>

            <div class="form-group">
                <label for="address">Address</label>
                <input type="text" id="address" name="address" value="{{ old('address') }}" placeholder="Enter supplier address" required>
            </div>

            <div class="form-buttons">
                <button type="submit" class="btn btn-primary">💾 Save Supplier</button>
                <a href="{{ route('suppliers.index') }}" class="btn btn-secondary">Cancel</a>
            </div>
        </form>
    </div>
</main>

@include('layouts.footer')
