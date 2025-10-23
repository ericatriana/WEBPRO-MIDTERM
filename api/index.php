<?php

// Enable error reporting for debugging
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Set up directories
$tmpDir = '/tmp';
if (!is_dir($tmpDir)) {
    mkdir($tmpDir, 0755, true);
}

// Create required cache directories
$cacheDir = '/tmp/cache';
if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

// Create SQLite database if it doesn't exist
$dbPath = '/tmp/database.sqlite';
if (!file_exists($dbPath)) {
    touch($dbPath);
    chmod($dbPath, 0666);
}

// Set environment variables if not already set
if (!getenv('APP_KEY')) {
    putenv('APP_KEY=base64:J8saLnWwsQPgil7GZouMlBJJlJpciFD1YCunv4a5kBc=');
}

if (!getenv('DB_CONNECTION')) {
    putenv('DB_CONNECTION=sqlite');
}

if (!getenv('DB_DATABASE')) {
    putenv('DB_DATABASE=' . $dbPath);
}

try {
    // Check if database is already initialized by checking for a flag file
    $dbInitFlag = '/tmp/db_initialized.flag';
    
    if (!file_exists($dbInitFlag)) {
        // Initialize database tables only once
        $pdo = new PDO('sqlite:' . $dbPath);
        
        // Check and create users table
        $result = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users'");
        if (!$result->fetch()) {
            $pdo->exec("CREATE TABLE users (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) UNIQUE NOT NULL,
                email_verified_at TIMESTAMP NULL,
                password VARCHAR(255) NOT NULL,
                remember_token VARCHAR(100) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
            
            // Insert test users
            $stmt = $pdo->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
            $stmt->execute(['Test User', 'test@example.com', password_hash('password', PASSWORD_DEFAULT)]);
            $stmt->execute(['Erica Triana', 'erica@example.com', password_hash('password123', PASSWORD_DEFAULT)]);
            $stmt->execute(['Demo User', 'rikatree3@gmail.com', password_hash('demo123', PASSWORD_DEFAULT)]);
            $stmt->execute(['Admin User', 'admin@warehouse.com', password_hash('admin123', PASSWORD_DEFAULT)]);
            $stmt->execute(['Manager User', 'manager@warehouse.com', password_hash('manager123', PASSWORD_DEFAULT)]);
        }
        
        // Check and create suppliers table
        $result = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='suppliers'");
        if (!$result->fetch()) {
            $pdo->exec("CREATE TABLE suppliers (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name VARCHAR(255) NOT NULL,
                contact VARCHAR(255) NULL,
                address TEXT NULL,
                phone VARCHAR(255) NULL,
                email VARCHAR(255) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
            )");
            
            // Insert test suppliers
            $stmt = $pdo->prepare("INSERT INTO suppliers (name, contact, address, phone, email) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute(['PT. Supplier Satu', 'John Doe', 'Jakarta Selatan', '021-123456', 'supplier1@example.com']);
            $stmt->execute(['CV. Supplier Dua', 'Jane Smith', 'Bandung', '022-789012', 'supplier2@example.com']);
            $stmt->execute(['UD. Supplier Tiga', 'Bob Wilson', 'Surabaya', '031-345678', 'supplier3@example.com']);
        }
        
        // Check and create products table
        $result = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='products'");
        if (!$result->fetch()) {
            $pdo->exec("CREATE TABLE products (
                id INTEGER PRIMARY KEY AUTOINCREMENT,
                name VARCHAR(255) NOT NULL,
                description TEXT NULL,
                price DECIMAL(10,2) NOT NULL,
                stock INTEGER NOT NULL DEFAULT 0,
                supplier_id INTEGER NULL,
                image VARCHAR(255) NULL,
                created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
                FOREIGN KEY (supplier_id) REFERENCES suppliers(id)
            )");
            
            // Insert test products
            $stmt = $pdo->prepare("INSERT INTO products (name, description, price, stock, supplier_id) VALUES (?, ?, ?, ?, ?)");
            $stmt->execute(['Laptop ASUS', 'Laptop gaming dengan spesifikasi tinggi', 15000000, 10, 1]);
            $stmt->execute(['Mouse Wireless', 'Mouse wireless dengan sensor optik', 250000, 50, 1]);
            $stmt->execute(['Keyboard Mechanical', 'Keyboard mechanical dengan switch blue', 800000, 25, 2]);
            $stmt->execute(['Monitor 24 inch', 'Monitor LED 24 inch Full HD', 2500000, 15, 2]);
            $stmt->execute(['Headset Gaming', 'Headset gaming dengan microphone', 450000, 30, 3]);
            $stmt->execute(['Webcam HD', 'Webcam HD 1080p untuk streaming', 350000, 20, 3]);
        }
        
        // Create flag file to indicate database is initialized
        touch($dbInitFlag);
    }
    
    // Forward Vercel requests to normal index.php
    require __DIR__ . '/../public/index.php';
} catch (Exception $e) {
    // Output error for debugging
    echo "Error: " . $e->getMessage() . "\n";
    echo "File: " . $e->getFile() . "\n";
    echo "Line: " . $e->getLine() . "\n";
    echo "Trace: " . $e->getTraceAsString() . "\n";
}