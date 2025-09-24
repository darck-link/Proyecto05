<x-guest-layout>
    <style>
        .password-container {
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

        .password-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .password-box {
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
            margin-bottom: 1.5rem;
        }

        .logo-text {
            font-size: 2.2rem;
            font-weight: 700;
            color: #1e40af;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .info-text {
            text-align: center;
            color: #374151;
            font-size: 1rem;
            margin-bottom: 2rem;
            line-height: 1.5;
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

        .btn-send {
            background: linear-gradient(135deg, #f59e0b, #fbbf24);
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

        .btn-send:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(245, 158, 11, 0.4);
            background: linear-gradient(135deg, #d97706, #f59e0b);
        }

        .back-link {
            text-align: center;
        }

        .back-link a {
            color: #1e40af;
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
        }

        .back-link a:hover {
            text-decoration: underline;
        }

        .success-message {
            background: rgba(16, 185, 129, 0.1);
            border: 1px solid #10b981;
            color: #065f46;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 1.5rem;
            font-size: 0.9rem;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .password-box {
                padding: 2rem 1.5rem;
                margin: 20px;
            }

            .logo-text {
                font-size: 1.8rem;
            }

            .info-text {
                font-size: 0.95rem;
            }
        }

        @media (max-width: 480px) {
            .password-box {
                padding: 1.5rem 1rem;
            }

            .logo-text {
                font-size: 1.6rem;
            }
        }
    </style>

    <div class="password-container">
        <div class="password-box">
            <div class="company-logo">
                <div class="logo-text">Servicios Premium S.A.</div>
            </div>
            
            <div class="info-text">
                ¿Olvidaste tu contraseña? No hay problema. Ingresa tu email y te enviaremos un enlace para restablecerla.
            </div>

            @if (session('status'))
                <div class="success-message">
                    {{ session('status') }}
                </div>
            @endif

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-input" type="email" name="email" :value="old('email')" required autofocus autocomplete="email" placeholder="tu@email.com">
                </div>

                <button type="submit" class="btn-send">
                    ENVIAR ENLACE DE RECUPERACIÓN
                </button>

                <div class="back-link">
                    <a href="{{ route('login') }}">← Volver al inicio de sesión</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>