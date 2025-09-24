<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Servicios Premium S.A.</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Nunito', sans-serif;
            min-height: 100vh;
        }

        .hero-section {
            background-image: url('/images/empresa.png');
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

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            z-index: 1;
        }

        /* Header superior responsive */
        .top-header {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 20px;
            z-index: 3;
            flex-wrap: wrap;
            gap: 15px;
        }

        .user-welcome {
            color: white;
            font-weight: 600;
            background: rgba(255, 255, 255, 0.2);
            padding: 10px 20px;
            border-radius: 25px;
            backdrop-filter: blur(10px);
            font-size: 0.9rem;
        }

        .admin-access {
            display: flex;
            gap: 10px;
        }

        .admin-btn {
            color: white;
            text-decoration: none;
            font-weight: 600;
            padding: 10px 20px;
            border-radius: 25px;
            transition: all 0.3s ease;
            background: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            backdrop-filter: blur(10px);
            font-size: 0.9rem;
            white-space: nowrap;
        }

        .admin-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
        }

        /* Cuadro central */
        .login-box {
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem;
            border-radius: 15px;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            text-align: center;
            max-width: 400px;
            width: 100%;
            z-index: 2;
            position: relative;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255, 255, 255, 0.2);
            margin: 80px 20px 20px 20px;
        }

        .company-logo {
            font-size: clamp(1.8rem, 4vw, 2.5rem);
            font-weight: 700;
            color: #1e40af;
            margin-bottom: 1rem;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            line-height: 1.2;
        }

        .welcome-text {
            color: #374151;
            font-size: clamp(0.9rem, 2vw, 1.1rem);
            margin-bottom: 2rem;
            line-height: 1.6;
        }

        .btn-primary {
            background: linear-gradient(135deg, #1e40af, #3b82f6);
            color: white;
            padding: 12px 20px;
            border: none;
            border-radius: 8px;
            font-size: clamp(0.9rem, 2vw, 1rem);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 1rem;
            box-shadow: 0 4px 15px rgba(59, 130, 246, 0.3);
            text-decoration: none;
            display: block;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(59, 130, 246, 0.4);
            background: linear-gradient(135deg, #1d4ed8, #2563eb);
        }

        .btn-secondary {
            background: transparent;
            color: #1e40af;
            padding: 12px 20px;
            border: 2px solid #1e40af;
            border-radius: 8px;
            font-size: clamp(0.9rem, 2vw, 1rem);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            width: 100%;
            margin-bottom: 1rem;
            text-decoration: none;
            display: block;
        }

        .btn-secondary:hover {
            background: #1e40af;
            color: white;
            transform: translateY(-2px);
        }

        .button-group {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .button-group .btn-primary,
        .button-group .btn-secondary {
            flex: 1;
            margin-bottom: 0;
            min-width: 120px;
        }

        /* ===== RESPONSIVE DESIGN ===== */

        /* Tablets y pantallas medianas */
        @media (max-width: 1024px) {
            .login-box {
                padding: 2rem;
                max-width: 350px;
            }
            
            .button-group {
                gap: 0.8rem;
            }
        }

        /* Tablets pequeñas y móviles grandes */
        @media (max-width: 768px) {
            .top-header {
                flex-direction: column;
                text-align: center;
                gap: 10px;
            }
            
            .user-welcome {
                order: 1;
            }
            
            .admin-access {
                order: 2;
                justify-content: center;
                flex-wrap: wrap;
            }
            
            .login-box {
                margin-top: 120px;
                padding: 1.5rem;
                max-width: 320px;
            }
            
            .button-group {
                flex-direction: column;
                gap: 0.8rem;
            }
            
            .button-group .btn-primary,
            .button-group .btn-secondary {
                min-width: auto;
            }
        }

        /* Móviles pequeños */
        @media (max-width: 480px) {
            .hero-section {
                padding: 15px;
            }
            
            .top-header {
                padding: 15px;
            }
            
            .login-box {
                margin: 100px 10px 10px 10px;
                padding: 1.5rem 1rem;
            }
            
            .company-logo {
                font-size: 1.8rem;
            }
            
            .welcome-text {
                font-size: 0.95rem;
            }
            
            .admin-btn {
                padding: 8px 16px;
                font-size: 0.85rem;
            }
            
            .user-welcome {
                font-size: 0.85rem;
                padding: 8px 16px;
            }
            
            .btn-primary, 
            .btn-secondary {
                padding: 10px 16px;
                font-size: 0.9rem;
            }
        }

        /* Móviles muy pequeños */
        @media (max-width: 360px) {
            .login-box {
                padding: 1rem;
            }
            
            .button-group {
                gap: 0.5rem;
            }
            
            .admin-access {
                flex-direction: column;
                align-items: center;
            }
            
            .admin-btn {
                width: 100%;
                text-align: center;
            }
        }

        /* Pantallas muy grandes */
        @media (min-width: 1440px) {
            .login-box {
                max-width: 450px;
                padding: 3rem;
            }
            
            .company-logo {
                font-size: 3rem;
            }
            
            .welcome-text {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>
    <div class="hero-section">
        <!-- Header superior -->
        <div class="top-header">
            <!-- Mensaje de bienvenida para usuarios logueados -->
            @auth
                <div class="user-welcome">
                    ¡Hola, {{ Auth::user()->name }}!
                </div>
            @endauth

            <!-- Acceso rápido -->
            <div class="admin-access">
                @auth
                    @if(Auth::user()->hasRole('admin'))
                        <a href="{{ route('admin.dashboard') }}" class="admin-btn">
                            Panel Admin
                        </a>
                    @else
                        <a href="{{ url('/dashboard') }}" class="admin-btn">
                            Mi Cuenta
                        </a>
                    @endif
                    <form method="POST" action="{{ route('logout') }}" style="display: inline;">
                        @csrf
                        <button type="submit" class="admin-btn" style="background: rgba(255, 0, 0, 0.2);">
                            Cerrar Sesión
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="admin-btn">
                        Acceso Staff
                    </a>
                @endauth
            </div>
        </div>

        <!-- Cuadro central -->
        <div class="login-box">
            <div class="company-logo">
                Servicios Premium S.A.
            </div>
            
            <div class="welcome-text">
                Bienvenido a nuestro sistema de reservas. Accede a tu cuenta o regístrate para comenzar.
            </div>

            @auth
                <div class="button-group">
                    <a href="{{ url('/dashboard') }}" class="btn-primary">
                        Ir al Dashboard
                    </a>
                    <a href="{{ route('reservas.create') }}" class="btn-secondary">
                        Nueva Reserva
                    </a>
                </div>
            @else
                <div class="button-group">
                    <a href="{{ route('login') }}" class="btn-primary">
                        Iniciar Sesión
                    </a>
                    
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn-secondary">
                            Registrarse
                        </a>
                    @endif
                </div>
            @endauth
        </div>
    </div>
</body>
</html>