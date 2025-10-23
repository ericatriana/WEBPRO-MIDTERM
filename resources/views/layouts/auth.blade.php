<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title', 'Warehouse App')</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <style>
        /* --- BASE STYLE --- */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
        }

        body {
            background-color: #DDEAF6; /* soft light blue background */
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        /* --- LOGIN CONTAINER --- */
        .login-container {
            width: 360px;
            background: #F5FAFF; /* very light blue */
            border-radius: 20px;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.15);
            overflow: hidden;
        }

        /* --- HEADER AREA --- */
        .login-header {
            background: linear-gradient(135deg, #4F9EC4, #70B5E0); /* blue gradient */
            color: white;
            padding: 60px 20px 40px;
            text-align: center;
            position: relative;
        }

        .login-header::after {
            content: "";
            position: absolute;
            bottom: -30px;
            left: 0;
            width: 100%;
            height: 60px;
            background-color: #A3D0F4; /* soft lighter blue curve */
            border-top-left-radius: 50% 40px;
            border-top-right-radius: 50% 40px;
        }

        .login-header h2 {
            font-size: 1.8rem;
            font-weight: 700;
            letter-spacing: 1px;
        }

        /* --- FORM SECTION --- */
        .login-form {
            padding: 50px 30px 30px;
        }

        .login-form label {
            font-weight: 600;
            color: #357ABD; /* deep blue text */
        }

        .login-form input {
            width: 100%;
            padding: 10px;
            border: 1.5px solid #70B5E0; /* blue border */
            border-radius: 8px;
            margin-top: 5px;
            margin-bottom: 15px;
            outline: none;
            background-color: #EFF8FF;
            transition: 0.2s ease;
        }

        .login-form input:focus {
            border-color: #4F9EC4;
            box-shadow: 0 0 4px rgba(79, 158, 196, 0.4);
        }

        /* --- BUTTON --- */
        .login-btn {
            width: 100%;
            background: linear-gradient(135deg, #4F9EC4, #70B5E0);
            color: white;
            border: none;
            border-radius: 10px;
            padding: 12px;
            font-weight: 600;
            cursor: pointer;
            font-size: 1rem;
            transition: 0.3s ease;
            box-shadow: 0 4px 10px rgba(79, 158, 196, 0.3);
        }

        .login-btn:hover {
            background: linear-gradient(135deg, #70B5E0, #4F9EC4);
            transform: translateY(-2px);
            box-shadow: 0 6px 14px rgba(79, 158, 196, 0.4);
        }

        .login-btn:disabled {
            background: #ccc;
            cursor: not-allowed;
            transform: none;
        }

        .loading {
            display: none;
            color: #357ABD;
            text-align: center;
            margin-top: 10px;
            font-size: 14px;
        }

        /* --- FOOTER SECTION (link bawah form) --- */
        .login-footer {
            text-align: center;
            margin-top: 20px;
            font-size: 14px;
            color: #555;
        }

        .login-footer a {
            color: #357ABD;
            font-weight: 600;
            text-decoration: none;
        }

        .login-footer a:hover {
            text-decoration: underline;
            color: #235A8C;
        }

        /* --- MAIN FOOTER (COPYRIGHT) --- */
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            text-align: center;
            color: #fff;
            background: linear-gradient(135deg, #4F9EC4, #70B5E0);
            padding: 12px 0;
            font-size: 14px;
            letter-spacing: 0.3px;
            box-shadow: 0 -2px 10px rgba(0,0,0,0.15);
        }
    </style>
    <script>
        // Handle CSRF token expired and loading state
        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('.login-form');
            const submitBtn = document.querySelector('.login-btn');
            
            if (form && submitBtn) {
                // Refresh CSRF token every 30 seconds
                setInterval(function() {
                    fetch(window.location.href, {
                        method: 'GET',
                        headers: {
                            'X-Requested-With': 'XMLHttpRequest',
                            'Accept': 'text/html'
                        }
                    })
                    .then(response => response.text())
                    .then(html => {
                        const parser = new DOMParser();
                        const doc = parser.parseFromString(html, 'text/html');
                        const newToken = doc.querySelector('meta[name="csrf-token"]');
                        const currentToken = document.querySelector('input[name="_token"]');
                        const metaToken = document.querySelector('meta[name="csrf-token"]');
                        
                        if (newToken && currentToken && metaToken) {
                            const tokenValue = newToken.getAttribute('content');
                            currentToken.value = tokenValue;
                            metaToken.setAttribute('content', tokenValue);
                        }
                    })
                    .catch(err => {
                        console.log('CSRF refresh failed:', err);
                    });
                }, 30000); // Refresh every 30 seconds
                
                form.addEventListener('submit', function(e) {
                    // Show loading state
                    submitBtn.disabled = true;
                    const originalText = submitBtn.textContent;
                    submitBtn.textContent = 'Processing...';
                    
                    // Add loading indicator
                    let loadingDiv = document.querySelector('.loading');
                    if (!loadingDiv) {
                        loadingDiv = document.createElement('div');
                        loadingDiv.className = 'loading';
                        loadingDiv.textContent = 'Please wait, processing your request...';
                        form.appendChild(loadingDiv);
                    }
                    loadingDiv.style.display = 'block';
                    
                    // Auto-reset if something goes wrong
                    setTimeout(function() {
                        if (submitBtn.disabled) {
                            submitBtn.disabled = false;
                            submitBtn.textContent = originalText;
                            if (loadingDiv) loadingDiv.style.display = 'none';
                        }
                    }, 30000); // 30 second timeout
                });
            }
        });
    </script>
</head>
<body>
    @yield('content')

    @include('layouts.footer')
</body>
</html>