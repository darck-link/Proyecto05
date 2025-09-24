<x-guest-layout>
    <style>
        .reset-container {
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

        .reset-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .reset-box {
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

        .password-strength {
            margin-top: 0.5rem;
            font-size: 0.8rem;
            color: #6b7280;
        }

        .btn-reset {
            background: linear-gradient(135deg, #ef4444, #f87171);
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

        .btn-reset:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(239, 68, 68, 0.4);
            background: linear-gradient(135deg, #dc2626, #ef4444);
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

        /* Responsive */
        @media (max-width: 768px) {
            .reset-box {
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
            .reset-box {
                padding: 1.5rem 1rem;
            }

            .logo-text {
                font-size: 1.6rem;
            }
        }
    </style>

    <div class="reset-container">
        <div class="reset-box">
            <div class="company-logo">
                <div class="logo-text">Servicios Premium S.A.</div>
            </div>
            
            <div class="info-text">
                Establece una nueva contraseña para tu cuenta.
            </div>

            <x-validation-errors class="mb-4" />

            <form method="POST" action="{{ route('password.update') }}">
                @csrf

                <input type="hidden" name="token" value="{{ $request->route('token') }}">

                <div class="form-group">
                    <label for="email" class="form-label">Email</label>
                    <input id="email" class="form-input" type="email" name="email" :value="old('email', $request->email)" required autofocus autocomplete="email" placeholder="tu@email.com">
                </div>

                <div class="form-group">
                    <label for="password" class="form-label">Nueva contraseña</label>
                    <input id="password" class="form-input" type="password" name="password" required autocomplete="new-password" placeholder="••••••••">
                    <div class="password-strength">Mínimo 8 caracteres</div>
                </div>

                <div class="form-group">
                    <label for="password_confirmation" class="form-label">Confirmar nueva contraseña</label>
                    <input id="password_confirmation" class="form-input" type="password" name="password_confirmation" required autocomplete="new-password" placeholder="••••••••">
                </div>

                <button type="submit" class="btn-reset">
                    RESTABLECER CONTRASEÑA
                </button>

                <div class="back-link">
                    <a href="{{ route('login') }}">← Volver al inicio de sesión</a>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>