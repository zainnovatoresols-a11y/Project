@extends('users.layout')

@section('content')
<style>
    .login-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 1.5rem;
    }

    .login-card {
        background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        max-width: 450px;
        width: 100%;
        padding: 2rem;
        text-align: center;
    }

    .login-card h3 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1f2937;
    }

    .login-card input.form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        color: #1f2937;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .login-card input.form-control:focus {
        border-color: #000;
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
    }

    .login-card .btn-login {
        background-color: #000;
        color: #fff;
        padding: 0.75rem 1.5rem;
        font-size: 0.875rem;
        font-weight: 600;
        border-radius: 0.375rem;
        width: 100%;
        border: none;
        transition: background-color 0.2s;
    }

    .login-card .btn-login:hover {
        background-color: #111;
    }

    .login-card a {
        color: #1f2937;
        text-decoration: none;
        font-size: 0.875rem;
        transition: color 0.2s;
    }

    .login-card a:hover {
        color: #000;
    }

    .text-danger {
        font-size: 0.75rem;
        margin-top: -0.5rem;
        margin-bottom: 0.5rem;
        text-align: left;
    }

    @media (max-width: 480px) {
        .login-card h3 {
            font-size: 1.5rem;
        }

        .login-card input.form-control {
            padding: 0.5rem 0.75rem;
        }

        .login-card .btn-login {
            padding: 0.5rem 1rem;
        }
    }
</style>

<div class="login-container">
    <div class="login-card">
        <h3>Login</h3>

        <form id="loginForm" method="POST" action="/login">
            @csrf

            <input type="email" id="email" name="email"
                class="form-control @error('email') is-invalid @enderror"
                placeholder="Email Address">
            <div id="emailError" class="text-danger"></div>

            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <input type="password" id="password" name="password"
                class="form-control @error('password') is-invalid @enderror"
                placeholder="Password">
            <div id="passwordError" class="text-danger"></div>

            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror

            <button type="submit" class="btn-login mt-3">Login</button>
        </form>

        <div class="mt-3">
            <a href="{{ route('users.create') }}">Don't have an account? Create Account</a>
        </div>
        <div class="mt-2">
            <a href="{{ route('welcome') }}">← Back to Welcome</a>
        </div>
    </div>
</div>

<script>
    const form = document.getElementById('loginForm');
    const emailInput = document.getElementById('email');
    const passwordInput = document.getElementById('password');

    const emailError = document.getElementById('emailError');
    const passwordError = document.getElementById('passwordError');

    let emailTimer;
    let passwordTimer;

    function validateEmail() {
        let email = emailInput.value.trim();
        emailError.innerText = '';

        if (!email) {
            emailError.innerText = 'Email is required';
            return false;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            emailError.innerText = 'Invalid email format';
            return false;
        } else if (email.length > 255) {
            emailError.innerText = 'Email must not exceed 255 characters';
            return false;
        }

        return true;
    }

    function validatePassword() {
        let password = passwordInput.value.trim();
        passwordError.innerText = '';

        if (!password) {
            passwordError.innerText = 'Password is required';
            return false;
        } else if (password.length > 72) {
            passwordError.innerText = 'Password must not exceed 72 characters';
            return false;
        }

        return true;
    }

    emailInput.addEventListener('input', function() {
        clearTimeout(emailTimer);
        emailTimer = setTimeout(validateEmail, 300);
    });

    passwordInput.addEventListener('input', function() {
        clearTimeout(passwordTimer);
        passwordTimer = setTimeout(validatePassword, 300);
    });

    form.addEventListener('submit', function(e) {
        let isEmailValid = validateEmail();
        let isPasswordValid = validatePassword();

        if (!isEmailValid || !isPasswordValid) {
            e.preventDefault();
        }
    });
</script>
@endsection