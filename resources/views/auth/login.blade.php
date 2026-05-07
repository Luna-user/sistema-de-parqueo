@extends('adminlte::auth.auth-page', ['auth_type' => 'login'])

@section('adminlte_css_pre')
    <link rel="stylesheet" href="{{ asset('vendor/icheck-bootstrap/icheck-bootstrap.min.css') }}">
    <style>
        /* Diseño Premium y Moderno para el Login */
        body.login-page {
            background: url('https://images.unsplash.com/photo-1573348722427-f1d6819fdf98?q=80&w=1920&auto=format&fit=crop') no-repeat center center fixed;
            background-size: cover;
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Inter', 'Segoe UI', sans-serif;
            margin: 0;
        }
        
        body.login-page::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(135deg, rgba(15, 32, 39, 0.9) 0%, rgba(32, 58, 67, 0.85) 50%, rgba(44, 83, 100, 0.9) 100%);
            z-index: 0;
        }

        .login-box {
            width: 420px;
            z-index: 1;
            margin: 0 20px;
        }

        .card {
            background: rgba(255, 255, 255, 0.95);
            border-radius: 15px;
            box-shadow: 0 15px 35px rgba(0,0,0,0.3);
            border: 1px solid rgba(255,255,255,0.2);
            backdrop-filter: blur(10px);
            overflow: hidden;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }
        
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.4);
        }

        .login-logo {
            padding: 30px 0 10px;
            margin-bottom: 0;
        }

        .login-logo a {
            color: #1a202c;
            font-weight: 800;
            font-size: 32px;
            text-transform: uppercase;
            letter-spacing: 1px;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.1);
        }
        
        .login-logo a b {
            color: #007bff;
        }

        .card-body {
            padding: 40px 35px;
        }

        .login-box-msg {
            color: #4a5568;
            font-weight: 500;
            padding: 0 0 25px;
            font-size: 15px;
        }

        .input-group {
            margin-bottom: 25px;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            transition: all 0.3s;
        }
        
        .input-group:focus-within {
            box-shadow: 0 4px 15px rgba(0, 123, 255, 0.2);
            transform: translateY(-2px);
        }

        .form-control {
            border: 1px solid #e2e8f0;
            padding: 12px 15px;
            height: auto;
            font-size: 15px;
            background-color: #f8fafc;
        }

        .form-control:focus {
            border-color: #007bff;
            background-color: #fff;
            box-shadow: none;
        }

        .input-group-text {
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-left: none;
            color: #a0aec0;
        }
        
        .input-group-text .fas {
            transition: color 0.3s;
        }
        
        .input-group:focus-within .input-group-text .fas {
            color: #007bff;
        }

        .btn-primary {
            background: linear-gradient(to right, #0056b3, #007bff);
            border: none;
            border-radius: 8px;
            padding: 12px;
            font-weight: 600;
            letter-spacing: 0.5px;
            text-transform: uppercase;
            box-shadow: 0 4px 10px rgba(0, 123, 255, 0.3);
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(to right, #004494, #0056b3);
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 123, 255, 0.4);
        }

        .icheck-primary label {
            font-weight: 500;
            color: #4a5568;
            cursor: pointer;
        }
        
        .login-footer-links {
            margin-top: 25px;
            text-align: center;
        }
        
        .login-footer-links a {
            color: #718096;
            font-size: 14px;
            text-decoration: none;
            transition: color 0.2s;
        }
        
        .login-footer-links a:hover {
            color: #007bff;
        }
        
        .invalid-feedback {
            font-size: 13px;
            margin-top: -15px;
            margin-bottom: 15px;
            display: block;
        }
    </style>
@stop

@section('auth_header', __('adminlte::adminlte.login_message'))

@section('auth_body')
    <form action="{{ route('login') }}" method="post">
        @csrf

        {{-- Email field --}}
        <div class="input-group">
            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}" placeholder="{{ __('adminlte::adminlte.email') }}" autofocus required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        @error('email')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        {{-- Password field --}}
        <div class="input-group">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="{{ __('adminlte::adminlte.password') }}" required>
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        @error('password')
            <span class="invalid-feedback text-danger" role="alert">
                <strong>{{ $message }}</strong>
            </span>
        @enderror

        {{-- Login button --}}
        <div class="row mt-4">
            <div class="col-12">
                <button type=submit class="btn btn-block btn-primary">
                    <span class="fas fa-sign-in-alt mr-2"></span>
                    {{ __('adminlte::adminlte.sign_in') }}
                </button>
            </div>
        </div>
        
        <div class="login-footer-links">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    <i class="fas fa-key mr-1"></i> {{ __('adminlte::adminlte.i_forgot_my_password') }}
                </a>
            @endif
        </div>
    </form>
@stop