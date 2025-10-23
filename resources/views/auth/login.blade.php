@extends('layouts.auth')

@section('title', 'Login')

@section('content')
<div class="login-container">
    <div class="login-header">
        <h2>Log In</h2>
    </div>

    @if(session('error'))
        <div style="color: red; text-align: center;">{{ session('error') }}</div>
    @endif
    @if(session('success'))
        <div style="color: green; text-align: center;">{{ session('success') }}</div>
    @endif

    <form class="login-form" method="POST" action="{{ route('login.process') }}">
        @csrf
        <label>Email</label>
        <input type="email" name="email" required placeholder="Enter your email">

        <label>Password</label>
        <input type="password" name="password" required placeholder="Enter your password">

        <button type="submit" class="login-btn">Login</button>

        <div class="loading" style="display: none;">
            Processing your login...
        </div>

        <div class="login-footer">
            <p>Don’t have an account? <a href="{{ route('register') }}">Sign up</a></p>
        </div>
    </form>
</div>
@endsection
