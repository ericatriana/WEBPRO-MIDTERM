@extends('layouts.auth')

@section('title', 'Register')

@section('content')
<div class="login-container">
    <div class="login-header">
        <h2>Create Your Account</h2>
    </div>

    <form class="login-form" method="POST" action="{{ route('register.process') }}" onsubmit="return checkPasswords()">
        @csrf

        <label>Name</label>
        <input type="text" name="name" required placeholder="Enter your full name">

        <label>Email</label>
        <input type="email" name="email" required placeholder="Enter your email">

        <label>Password</label>
        <input type="password" id="password" name="password" required placeholder="Enter your password">

        <label>Confirm Password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required placeholder="Confirm your password">

        <button type="submit" class="login-btn">Register</button>

        <div class="login-footer">
            <p>Already have an account? <a href="{{ route('login') }}">Sign in</a></p>
        </div>
    </form>
</div>

<script>
function checkPasswords() {
    const password = document.getElementById('password').value;
    const confirm = document.getElementById('password_confirmation').value;
    if (password !== confirm) {
        alert('Passwords do not match!');
        return false;
    }
    return true;
}
</script>
@endsection
