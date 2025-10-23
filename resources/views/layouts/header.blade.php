<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Inventory Manager</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header class="main-header">
    <div class="container">
        <div class="logo">Product Inventory Manager</div>
        <nav class="navbar">
            <ul>
                <li><a href="{{ route('products.index') }}" class="{{ request()->is('products*') ? 'active' : '' }}">Products</a></li>
                <li><a href="{{ route('suppliers.index') }}" class="{{ request()->is('suppliers*') ? 'active' : '' }}">Suppliers</a></li>
                <li><a href="{{ route('dashboard') }}" class="{{ request()->is('dashboard*') ? 'active' : '' }}">Dashboard</a></li>
            </ul>
        </nav>
    </div>
</header>
