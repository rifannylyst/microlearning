<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Microlearning</title>
    <!-- Google Fonts Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background-color: #f8fafc;
            background-image: 
                radial-gradient(at 50% 0%, rgba(59, 130, 246, 0.08) 0px, transparent 50%),
                radial-gradient(at 0% 100%, rgba(99, 102, 241, 0.04) 0px, transparent 50%);
            min-height: 100vh;
            color: #334155;
        }
        .login-card {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05) !important;
        }
        .login-card .form-control {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #1e293b;
            font-size: 0.9rem;
            padding: 0.6rem 0.9rem;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
        }
        .login-card .form-control:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }
        .login-card .form-label {
            color: #475569;
            font-weight: 500;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }
        .login-card .btn-primary {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            border: none;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
            color: #ffffff;
            font-weight: 500;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }
        .login-card .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8, #4338ca);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
        }
        .login-brand {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
        }
        .login-brand img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        .login-footer p {
            color: #64748b;
            font-size: 0.85rem;
        }
        .login-footer a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            transition: color 0.15s ease;
        }
        .login-footer a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }
        .text-muted-custom {
            color: #64748b;
            font-size: 0.85rem;
            line-height: 1.5;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card login-card p-4 shadow-lg" style="width: 420px; border: none;">
            <div class="text-center mb-4">
                <div class="login-brand mx-auto mb-3"><img src="{{ asset('logo.jpg') }}" alt="Logo"></div>
                <h3 class="fw-bold text-slate-900" style="font-size: 1.5rem;">Selamat Datang</h3>
                <p class="text-muted-custom mb-0">Masuk untuk melanjutkan dan kelola konten pembelajaran Anda.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required placeholder="Masukkan email">
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                        <input
                            type="password"
                            name="password"
                            id="editPassword"
                            class="form-control pe-5 password-input"
                            placeholder="Masukkan password"
                            required>

                        <span class="toggle-password position-absolute top-50 end-0 translate-middle-y me-3 text-slate-400"
                            style="cursor: pointer;">
                            <i class="bi bi-eye"></i>
                        </span>
                    </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2.5 mt-2">Login</button>
            </form>

            <div class="text-center mt-4 login-footer">
                <p class="mb-1">Belum punya akun?</p>
                <a href="{{ route('register') }}">Daftar sekarang</a>
            </div>
        </div>
    </div>
    <script>
    const password = document.getElementById('password');
    const toggle = document.getElementById('togglePassword');
    const icon = document.getElementById('eyeIcon');

    document.addEventListener('click', function (e) {

        const toggle = e.target.closest('.toggle-password');

        if (!toggle) return;

        const container = toggle.closest('.position-relative');
        const input = container.querySelector('.password-input');
        const icon = toggle.querySelector('i');

        if (!input) return;

        if (input.type === 'password') {
            input.type = 'text';
            icon.classList.replace('bi-eye', 'bi-eye-slash');
        } else {
            input.type = 'password';
            icon.classList.replace('bi-eye-slash', 'bi-eye');
        }

    });
    </script>
</body>
</html>