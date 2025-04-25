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
    .register-card {
        background: #2b2b4f;
        padding: 2rem;
        border-radius: 15px;
        box-shadow: 0 10px 25px rgba(0,0,0,0.5);
        width: 100%;
        max-width: 450px;
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
    .nav-link {
        text-align: center;
        color: #ccc;
        font-weight: bold;
        margin-top: 10px;
        display: block;
        transition: color 0.3s ease;
    }
    .nav-link:hover {
        color: #fff;
    }
</style>

<div class="register-card">
    <h2 class="text-center mb-4">Crear Cuenta</h2>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <input id="name" type="text" placeholder="Nombre" class="form-control @error('name') is-invalid @enderror" name="name" required autofocus>
            @error('name')
                <span class="invalid-feedback d-block mt-1" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <input id="email" type="email" placeholder="Correo electrónico" class="form-control @error('email') is-invalid @enderror" name="email" required>
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

        <div class="mb-3">
            <input id="password-confirm" type="password" placeholder="Confirmar Contraseña" class="form-control" name="password_confirmation" required>
        </div>

        <div class="d-grid mb-2">
            <button type="submit" class="btn btn-custom">
                Registrarse
            </button>
        </div>

        <a class="nav-link" href="{{ route('login') }}">
            ¿Ya tienes una cuenta? Inicia sesión
        </a>
    </form>
</div>
@endsection
