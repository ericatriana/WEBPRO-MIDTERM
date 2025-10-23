<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventory Manager')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
    <header class="main-header">
        <div class="container">
            <h1 class="logo">Product Inventory Manager</h1>
            <nav class="navbar">
    <ul>
        <li><a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard*') ? 'active' : '' }}">Dashboard</a></li>
        <li><a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'active' : '' }}">Products</a></li>
        <li><a href="{{ route('suppliers.index') }}" class="{{ request()->is('suppliers*') ? 'active' : '' }}">Suppliers</a></li>
        <li>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="nav-link-logout {{ request()->is('logout') ? 'active' : '' }}">
                    Logout
                </button>
            </form>
        </li>
    </ul>
</nav>

        </div>
    </header>

    {{-- 🔹 Konten halaman --}}
    <main class="content">
        @yield('content')
    </main>

    {{-- 🔹 Footer --}}
    <footer class="footer">
        <p>© {{ date('Y') }} Fayza & Erica. All rights reserved.</p>
    </footer>
</body>
</html>
