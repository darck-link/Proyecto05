<x-guest-layout>
    <style>
        .login-container {
            background-image: url('/images/empresa2.png');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            position: relative;
            padding: 20px;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .login-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 420px;
            z-index: 2;
            position: relative;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .company-logo {
            text-align: center;
            margin-bottom: 2rem;
        }

        .logo-text {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1e40af;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .welcome-text {
            text-align: center;
            color: #374151;
            font-size: 1.1rem;
            margin-bottom: 2rem;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        .form-label {
            display: block;
            color: #374151;
            font-weight: 600;
            margin-bottom: 0.5rem;
            font-size: 0.95rem;
        }

        .form-input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #e2e8f0;
            border-radius: 8px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: white;
        }

        .form-input:focus {
            outline: none;
            border-color: #3b82f6;
            box-shadow: 0 0 0 3px rgba(59, 130, 246, 0.1);
        }

        .checkbox-group {
            display: flex;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .checkbox {
            margin-right: 0.5rem;
            width: 16px;
            height: 16px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
        }

        .checkbox-label {
            color: #374151;
            font-size: 0.9rem;
            cursor: pointer;
        }

        .btn-login {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: white;
            width: 100%;
            padding: 12px;
            border: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-bottom: 1.5rem;
        }

        .btn-login:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
        }

        .links-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .forgot-password {
            color: #1e40af;
            text-decoration: none;
            font-size: 0.9rem;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .forgot-password:hover {
            color: #1e3a8a;
            text-decoration: underline;
        }

        .register-link {
            color: #374151;
            font-size: 0.9rem;
        }

        .register-link a {
            color: #1e40af;
            text-decoration: none;
            font-weight: 500;
        }

        .register-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .login-box {
                padding: 2rem 1.5rem;
                margin: 20px;
            }

            .logo-text {
                font-size: 1.8rem;
            }

            .welcome-text {
                font-size: 1rem;
            }

            .links-container {
                flex-direction: column;
                text-align: center;
                gap: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .login-box {
                padding: 1.5rem 1rem;
            }

            .logo-text {
                font-size: 1.6rem;
            }
        }
    </style>

    <div class="login-container">
        <div class="login-box">
            <div class="company-logo">
                <div class="logo-text">Servicios Premium S.A.</div>
            </div>
            
            <div class="welcome-text">
                Inicia sesión en tu cuenta
            </div>

            <x-validation-errors class="mb-4" />

            @if (session('status'))
                <div class="mb-4 font-medium text-sm text-green-600">
                    {{ session('status') }}
                </div>
            @endif

            <form method="POST" action="{{ route('login') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" placeholder="tu@email.com">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" class="form-input" type="password" name="password" required autocomplete="current-password" placeholder="••••••••">
                </div>

                <div class="checkbox-group">
                    <input id="remember_me" type="checkbox" class="checkbox" name="remember">
                    <label for="remember_me" class="checkbox-label">Recordar sesión</label>
                </div>

                <button type="submit" class="btn-login">
                    INICIAR SESIÓN
                </button>

                <div class="links-container">
                    @if (Route::has('password.request'))
                        <a class="forgot-password" href="{{ route('password.request') }}">
                            ¿Olvidaste tu contraseña?
                        </a>
                    @endif

                    @if (Route::has('register'))
                        <div class="register-link">
                            ¿No tienes cuenta? <a href="{{ route('register') }}">Regístrate</a>
                        </div>
                    @endif
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>