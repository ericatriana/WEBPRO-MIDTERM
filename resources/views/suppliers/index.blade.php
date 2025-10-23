@include('layouts.header')

<main class="content">
    <div class="header-row">
        <h3>Supplier List</h3>
        <a href="{{ route('suppliers.create') }}" class="btn-add">+ Add New Supplier</a>
    </div>

    <!-- 🔍 Search & Filter Bar -->
    <form method="GET" action="{{ route('suppliers.index') }}" class="filter-bar" 
          style="display:flex; flex-wrap:wrap; gap:10px; margin-bottom:20px;">
        <input 
            type="text" 
            name="search" 
            value="{{ request('search') }}" 
            placeholder="Search by name or email..." 
            style="flex:2; padding:10px; border:1.5px solid #FFD0C7; border-radius:10px;"
        >

        <select name="sort" style="flex:1; padding:10px; border:1.5px solid #FFD0C7; border-radius:10px;">
            <option value="">Sort by Name</option>
            <option value="asc" {{ request('sort') == 'asc' ? 'selected' : '' }}>A → Z</option>
            <option value="desc" {{ request('sort') == 'desc' ? 'selected' : '' }}>Z → A</option>
        </select>

        <button type="submit" class="btn-primary" style="flex:0.5; padding:10px 20px;">Search</button>
        <a href="{{ route('suppliers.index') }}" class="reset-button" style="flex:0.5; text-align:center;">Reset</a>

    </form>

    <!-- 📋 Supplier Table -->
    <div class="table-wrapper">
        <table class="table-custom">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Contact</th>
                    <th>Email</th>
                    <th>Address</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($allSuppliers as $supplier)
                    <tr>
                        <td>{{ $supplier->id }}</td>
                        <td>{{ $supplier->name }}</td>
                        <td>{{ $supplier->contact }}</td>
                        <td>{{ $supplier->email ?? '-' }}</td>
                        <td>{{ $supplier->address ?? '-' }}</td>
                        <td>
                            <div class="action-buttons" style="display:flex; flex-direction:column; gap:5px;">
                                <a href="{{ route('suppliers.show', $supplier->id) }}" class="btn-action view">View</a>
                                <a href="{{ route('suppliers.edit', $supplier->id) }}" class="btn-action edit">Edit</a>
                                <form action="{{ route('suppliers.destroy', $supplier->id) }}" method="POST" 
                                      onsubmit="return confirm('Delete this supplier?')" style="margin:0;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn-action delete">Delete</button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align:center; color:#aaa; padding:20px;">
                            No suppliers found.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</main>

@include('layouts.footer')
