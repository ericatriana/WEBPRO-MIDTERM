<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Dashboard - Warehouse App')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* === GLOBAL BASE === */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #E6F2F8; /* soft light blue */
            color: #333;
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        /* === HEADER === */
        .main-header {
            background: linear-gradient(135deg, #4A90E2, #357ABD); /* gradient biru */
            color: #fff;
            padding: 15px 0;
            box-shadow: 0 2px 8px rgba(0,0,0,0.2);
        }

        .container {
            width: 90%;
            max-width: 1200px;
            margin: auto;
            display: flex;
            align-items: center;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        .logo {
            font-size: 1.6rem;
            font-weight: 600;
            color: #fff;
            letter-spacing: 0.5px;
        }

        /* === NAVBAR === */
        .navbar ul {
            list-style: none;
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
        }

        .navbar a {
            text-decoration: none;
            color: #fff;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .navbar a:hover,
        .navbar a.active {
            background-color: #B3D9FF; /* soft cream blue */
            color: #357ABD;
        }

        .navbar form {
            display: inline;
            margin: 0;
            padding: 0;
        }

        .nav-link-logout {
            background: none;
            border: none;
            color: #fff;
            font-weight: 500;
            padding: 8px 16px;
            line-height: 1;
            border-radius: 10px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-family: inherit;
            font-size: inherit;
        }

        .nav-link-logout:hover {
            background-color: #B3D9FF; 
            color: #357ABD;
        }

        /* === DASHBOARD PAGE === */
        .dashboard-wrapper {
            max-width: 1100px;
            margin: 40px auto;
            padding: 20px;
            background: #EAF4FB;
            border-radius: 20px;
            box-shadow: 0 8px 20px rgba(0,0,0,0.1);
        }

        .welcome-section {
            text-align: center;
            margin-bottom: 30px;
        }

        .welcome-section h1 {
            font-size: 28px;
            color: #357ABD;
            margin-bottom: 8px;
        }

        .welcome-section h2 {
            font-size: 24px;
            color: #357ABD;
            margin-bottom: 8px;
        }

        .welcome-section p {
            color: #555;
            margin-top: 5px;
        }

        /* === STATS GRID === */
        .stats-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat-card {
            background: #F0F7FF;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            padding: 25px;
            text-align: center;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.2);
        }

        .stat-number {
            font-size: 2.5rem;
            font-weight: 600;
            color: #4A90E2;
            margin-bottom: 8px;
        }

        .stat-label {
            color: #357ABD;
            font-weight: 500;
            font-size: 0.95rem;
        }

        /* === PRODUCT GRID === */
        .product-grid {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 25px;
        }

        .product-card {
            background: #F0F7FF;
            border-radius: 16px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .product-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 18px rgba(0,0,0,0.2);
        }

        .product-info {
            padding: 20px;
            text-align: center;
        }

        .product-info h3 {
            color: #4A90E2;
            font-size: 18px;
            margin-bottom: 8px;
        }

        .product-info .price {
            font-weight: bold;
            color: #333;
            font-size: 1.1rem;
            margin-bottom: 6px;
        }

        .product-info .stock {
            color: #666;
            font-size: 14px;
            margin-bottom: 8px;
        }

        .product-info .supplier-info {
            color: #357ABD;
            font-size: 0.9rem;
            font-weight: 500;
            background: #E0F0FF;
            padding: 6px 12px;
            border-radius: 8px;
            margin-top: 10px;
        }

        .text-center {
            text-align: center;
            color: #666;
            padding: 40px 20px;
        }

        .text-center a {
            color: #4A90E2;
            text-decoration: none;
            font-weight: 600;
            background: #E0F0FF;
            padding: 10px 20px;
            border-radius: 10px;
            display: inline-block;
            margin-top: 15px;
            transition: all 0.3s ease;
        }

        .text-center a:hover {
            background: #4A90E2;
            color: #fff;
            transform: translateY(-2px);
        }

        /* === RESPONSIVE === */
        @media (max-width: 600px) {
            .container {
                flex-direction: column;
                text-align: center;
            }
            .navbar ul {
                justify-content: center;
                gap: 10px;
            }
            .dashboard-wrapper {
                margin: 20px;
                padding: 15px;
            }
            .stats-grid {
                grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
                gap: 15px;
            }
            .product-grid {
                grid-template-columns: 1fr;
                gap: 20px;
            }
        }
    </style>
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
                            <button type="submit" class="nav-link-logout">
                                Logout
                            </button>
                        </form>
                    </li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        @yield('content')
    </main>
</body>
</html>