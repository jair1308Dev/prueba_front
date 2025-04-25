@extends('layouts.app')

@section('content')
<style>
    body {
        background: linear-gradient(135deg, #1e1e2f, #3d2c8d);
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .login-card {
        background: #2b2b4f;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        width: 100%;
        max-width: 400px;
        color: #fff;
    }
    .form-control {
        background-color: #f1f1f1;
        border: none;
        border-radius: 10px;
        padding: 0.75rem;
    }
    .btn-custom {
        background-color: #6c4ad4;
        border: none;
        width: 100%;
        padding: 0.75rem;
        font-weight: bold;
        border-radius: 10px;
        transition: background-color 0.3s ease;
    }
    .btn-custom:hover {
        background-color: #5a39b8;
    }
    .form-check-label {
        color: #ccc;
    }
</style>

<div class="login-card">
    <h2 class="text-center mb-4">Iniciar Sesión</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="mb-3">
            <input id="email" type="email" placeholder="Correo electrónico" class="form-control @error('email') is-invalid @enderror" name="email" required autofocus>
            @error('email')
                <span class="invalid-feedback d-block mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <input id="password" type="password" placeholder="Contraseña" class="form-control @error('password') is-invalid @enderror" name="password" required>
            @error('password')
                <span class="invalid-feedback d-block mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3 form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember">
            <label class="form-check-label" for="remember">
                Recordarme
            </label>
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-custom">
                Iniciar sesión
            </button>
        </div>
    </form>
</div>
@endsection
