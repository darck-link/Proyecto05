<x-guest-layout>
    <style>
        .register-container {
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

        .register-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .register-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            width: 100%;
            max-width: 450px;
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

        .terms-group {
            margin: 1.5rem 0;
            padding: 1rem;
            background: rgba(59, 130, 246, 0.05);
            border-radius: 8px;
            border-left: 4px solid #3b82f6;
        }

        .terms-checkbox {
            display: flex;
            align-items: flex-start;
            gap: 0.5rem;
        }

        .terms-checkbox input {
            margin-top: 0.25rem;
            width: 16px;
            height: 16px;
            border: 2px solid #d1d5db;
            border-radius: 4px;
            cursor: pointer;
        }

        .terms-label {
            color: #374151;
            font-size: 0.9rem;
            line-height: 1.4;
        }

        .terms-label a {
            color: #1e40af;
            text-decoration: none;
            font-weight: 500;
        }

        .terms-label a:hover {
            text-decoration: underline;
        }

        .btn-register {
            background: linear-gradient(135deg, #10b981, #34d399);
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

        .btn-register:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(16, 185, 129, 0.4);
            background: linear-gradient(135deg, #0da271, #2ec288);
        }

        .links-container {
            display: flex;
            justify-content: center;
            align-items: center;
            flex-wrap: wrap;
            gap: 0.5rem;
            text-align: center;
        }

        .login-link {
            color: #374151;
            font-size: 0.9rem;
        }

        .login-link a {
            color: #1e40af;
            text-decoration: none;
            font-weight: 500;
        }

        .login-link a:hover {
            text-decoration: underline;
        }

        .error-message {
            color: #dc2626;
            font-size: 0.85rem;
            margin-top: 0.25rem;
        }

        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: #6b7280;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .register-box {
                padding: 2rem 1.5rem;
                margin: 20px;
                max-width: 400px;
            }

            .logo-text {
                font-size: 1.8rem;
            }

            .welcome-text {
                font-size: 1rem;
            }

            .terms-group {
                padding: 0.8rem;
            }
        }

        @media (max-width: 480px) {
            .register-box {
                padding: 1.5rem 1rem;
            }

            .logo-text {
                font-size: 1.6rem;
            }

            .links-container {
                flex-direction: column;
                gap: 0.8rem;
            }
        }
    </style>

    <div class="register-container">
        <div class="register-box">
            <div class="company-logo">
                <div class="logo-text">NOMBRE EMPRESA</div>
            </div>
            
            <div class="welcome-text">
                Crea tu cuenta para comenzar
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('register') }}">
                @csrf

                <div class="form-group">
                    <label for="name" class="form-label">Nombre completo</label>
                    <input id="name" class="form-input" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" placeholder="Tu nombre completo">
                </div>

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autocomplete="email" placeholder="tu@email.com">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Contraseña</label>
                    <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="••••••••">
                    <div class="password-strength">Mínimo 8 caracteres</div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmar contraseña</label>
                    <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                </div>

                @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                    <div class="terms-group">
                        <div class="terms-checkbox">
                            <input id="terms" name="terms" type="checkbox" required>
                            <label for="terms" class="terms-label">
                                Acepto los <a target="_blank" href="{{ route('terms.show') }}">Términos de Servicio</a> 
                                y la <a target="_blank" href="{{ route('policy.show') }}">Política de Privacidad</a>
                            </label>
                        </div>
                    </div>
                @endif

                <button type="submit" class="btn-register">
                    CREAR CUENTA
                </button>

                <div class="links-container">
                    <div class="login-link">
                        ¿Ya tienes cuenta? <a href="{{ route('login') }}">Iniciar sesión</a>
                    </div>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>