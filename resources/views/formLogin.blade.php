<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Microlearning</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <style>
        body {
            background: radial-gradient(circle at top, rgba(56, 189, 248, 0.22), transparent 28%),
                        linear-gradient(180deg, #0f172a 0%, #020617 100%);
            min-height: 100vh;
            color: #f8fafc;
        }
        .login-card {
            background: rgba(15, 23, 42, 0.96);
            border: 1px solid rgba(148, 163, 184, 0.12);
        }
        .login-card .form-control {
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(148, 163, 184, 0.18);
            color: #f8fafc;
        }
        .login-card .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25);
            border-color: #38bdf8;
        }
        .login-card .form-label {
            color: #cbd5e1;
        }
        .login-card .btn-primary {
            background: #1e293b;
            border: none;
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.24);
            color: #f8fafc;
        }
        .login-card .btn-primary:hover {
            background: #334155;
        }
        .login-brand {
            width: 72px;
            height: 72px;
            border-radius: 22px;
            background: linear-gradient(135deg, #38bdf8, #818cf8);
            display: grid;
            place-items: center;
            color: #0f172a;
            font-weight: 700;
            font-size: 1.4rem;
        }
        .login-footer a {
            color: #7dd3fc;
            text-decoration: none;
        }
        .login-footer a:hover {
            text-decoration: underline;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card login-card p-4 shadow-lg" style="width: 420px;">
            <div class="text-center mb-4">
                <div class="login-brand mx-auto mb-3"><img src="{{ asset('logo.jpg') }}" alt="Logo" class="img-fluid"></div>
                <h3 class="fw-bold text-white">Selamat Datang</h3>
                <p class="text-white mb-0">Masuk untuk melanjutkan dan kelola konten pembelajaran Anda.</p>
            </div>

            <form method="POST" action="{{ route('login') }}">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <div class="position-relative">
                    <input type="password" class="form-control mb-3" id="password" name="password" required>
                    <span class="toggle-password position-absolute top-50 end-0 translate-middle-y me-3"
                            style="cursor: pointer;">
                            <i class="bi bi-eye"></i>
                        </span>
                </div>
                </div>
                <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
            </form>

            <div class="text-center text-white mt-4 login-footer">
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