@extends('users.layout')

@section('content')
<style>
    .registration-container {
        display: flex;
        justify-content: center;
        align-items: center;
        min-height: 80vh;
        padding: 1.5rem;
    }

    .registration-card {
        background-color: #fff;
        border-radius: 0.5rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        max-width: 450px;
        width: 100%;
        padding: 2rem;
        text-align: center;
    }

    .registration-card h3 {
        font-size: 1.75rem;
        font-weight: 700;
        margin-bottom: 1.5rem;
        color: #1f2937;
    }

    .registration-card input.form-control {
        width: 100%;
        padding: 0.75rem 1rem;
        margin-bottom: 1rem;
        border: 1px solid #d1d5db;
        border-radius: 0.375rem;
        font-size: 0.875rem;
        color: #1f2937;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .registration-card input.form-control:focus {
        border-color: #000;
        outline: none;
        box-shadow: 0 0 0 2px rgba(0, 0, 0, 0.1);
    }

    .registration-card .btn-register {
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

    .registration-card .btn-register:hover {
        background-color: #111;
    }

    .registration-card a {
        color: #1f2937;
        text-decoration: none;
        font-size: 0.875rem;
        transition: color 0.2s;
    }

    .registration-card a:hover {
        color: #000;
    }

    .text-danger {
        font-size: 0.75rem;
        margin-top: -0.5rem;
        margin-bottom: 0.5rem;
        text-align: left;
    }

    @media (max-width: 480px) {
        .registration-card h3 {
            font-size: 1.5rem;
        }

        .registration-card input.form-control {
            padding: 0.5rem 0.75rem;
        }

        .registration-card .btn-register {
            padding: 0.5rem 1rem;
        }
    }
</style>

<div class="registration-container">
    <div class="registration-card">
        <h3>Create Account</h3>

        <form id="registerForm" action="{{ route('users.store') }}" method="POST">
            @csrf
            <div id="clientErrors"></div>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" placeholder="Full Name">
            @error('name')
            <div class="text-danger">{{ $message }}</div>
            @enderror


            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror" placeholder="Email Address">
            @error('email')
            <div class="text-danger">{{ $message }}</div>
            @enderror


            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
            @error('password')
            <div class="text-danger">{{ $message }}</div>
            @enderror


            <input type="password" name="password_confirmation" class="form-control" placeholder="Confirm Password">

            <button type="submit" class="btn-register mt-3">Register</button>
        </form>

        <div class="mt-3">
            <a href="{{ route('login') }}">Already have an account? Login</a>
        </div>
        <div class="mt-2">
            <a href="{{ route('welcome') }}">← Back to Welcome</a>
        </div>
    </div>
</div>
<script>
    const form = document.getElementById('registerForm');
    const errorBox = document.getElementById('clientErrors');

    const nameInput = document.querySelector('[name="name"]');
    const emailInput = document.querySelector('[name="email"]');
    const passwordInput = document.querySelector('[name="password"]');
    const confirmInput = document.querySelector('[name="password_confirmation"]');

    function validate() {
        let errors = [];

        let name = nameInput.value.trim();
        let email = emailInput.value.trim();
        let password = passwordInput.value;
        let confirmPassword = confirmInput.value;

        if (name === '') {
            errors.push("Full name is required.");
        } else if (name.length > 255) {
            errors.push("Name cannot exceed 255 characters.");
        }

        let emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        if (email === '') {
            errors.push("Email is required.");
        } else if (!emailPattern.test(email)) {
            errors.push("Enter a valid email address.");
        }

        if (password.length < 8) {
            errors.push("Password must be at least 8 characters.");
        } else {
            if (!/[A-Z]/.test(password)) {
                errors.push("Password must contain uppercase.");
            }
            if (!/[a-z]/.test(password)) {
                errors.push("Password must contain lowercase.");
            }
        }

        if (password !== confirmPassword) {
            errors.push("Passwords do not match.");
        }

        errorBox.innerHTML = '';
        errors.forEach(err => {
            errorBox.innerHTML += `<div class="text-danger">${err}</div>`;
        });

        return errors.length === 0;
    }

    nameInput.addEventListener('input', validate);
    emailInput.addEventListener('input', validate);
    passwordInput.addEventListener('input', validate);
    confirmInput.addEventListener('input', validate);

    form.addEventListener('submit', function(e) {
        if (!validate()) {
            e.preventDefault();
        }
    });
</script>
@endsection