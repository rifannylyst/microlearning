<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Microlearning</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            background: radial-gradient(circle at top,
                        rgba(56, 189, 248, 0.22),
                        transparent 28%),
                        linear-gradient(180deg,
                        #0f172a 0%,
                        #020617 100%);
            min-height: 100vh;
            color: #f8fafc;
        }

        .register-card {
            background: rgba(15, 23, 42, 0.96);
            border: 1px solid rgba(148, 163, 184, 0.12);
            border-radius: 20px;
        }

        .register-card .form-control {
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(148, 163, 184, 0.18);
            color: #f8fafc;
        }

        .register-card .form-control:focus {
            box-shadow: 0 0 0 0.25rem rgba(14, 165, 233, 0.25);
            border-color: #38bdf8;
        }

        .register-card .form-label {
            color: #cbd5e1;
        }

        .register-card .btn-primary {
            background: #1e293b;
            border: none;
            box-shadow: 0 10px 22px rgba(15, 23, 42, 0.24);
            color: #f8fafc;
        }

        .register-card .btn-primary:hover {
            background: #334155;
        }

        .register-brand {
            width: 72px;
            height: 72px;
            border-radius: 22px;
            background: linear-gradient(135deg, #38bdf8, #818cf8);
            display: grid;
            place-items: center;
            margin: auto;
            overflow: hidden;
        }

        .register-brand img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .register-footer a {
            color: #7dd3fc;
            text-decoration: none;
        }

        .register-footer a:hover {
            text-decoration: underline;
        }
        .input-group .btn {
            background: rgba(15, 23, 42, 0.75);
            border: 1px solid rgba(148, 163, 184, 0.18);
            color: #cbd5e1;
        }

        .input-group .btn:hover {
            background: #334155;
            color: white;
        }
    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center py-5 min-vh-100">

    <div class="card register-card p-4 shadow-lg" style="width: 460px;">

        <div class="text-center mb-4">

            <div class="register-brand mb-3">
                <img src="{{ asset('logo.jpg') }}" alt="Logo">
            </div>

            <h3 class="fw-bold text-white">
                Buat Akun Baru
            </h3>

            <p class="text-white mb-0">
                Bergabunglah dengan MicroLearn dan mulai belajar sekarang.
            </p>

        </div>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div class="mb-3">
                <label class="form-label">
                    Nama Lengkap
                </label>

                <input
                    type="text"
                    name="name"
                    class="form-control"
                    value="{{ old('name') }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Email Address
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Password
                </label>

                <div class="input-group">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="form-control"
                        required>

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        onclick="togglePassword('password', 'passwordIcon')">

                        <i id="passwordIcon" class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <div class="mb-4">
                <label class="form-label">
                    Konfirmasi Password
                </label>

                <div class="input-group">
                    <input
                        type="password"
                        name="password_confirmation"
                        id="password_confirmation"
                        class="form-control"
                        required>

                    <button
                        type="button"
                        class="btn btn-outline-secondary"
                        onclick="togglePassword('password_confirmation', 'confirmIcon')">

                        <i id="confirmIcon" class="bi bi-eye"></i>
                    </button>
                </div>
            </div>

            <button
                type="submit"
                class="btn btn-primary w-100 py-2">
                Daftar
            </button>

        </form>

        <div class="text-center text-white mt-4 register-footer">

            <p class="mb-1">
                Sudah punya akun?
            </p>

            <a href="{{ route('login') }}">
                Masuk sekarang
            </a>

        </div>

    </div>

</div>

<script>
function togglePassword(inputId, iconId) {

    const input = document.getElementById(inputId);
    const icon = document.getElementById(iconId);

    if (input.type === 'password') {
        input.type = 'text';

        icon.classList.remove('bi-eye');
        icon.classList.add('bi-eye-slash');
    } else {
        input.type = 'password';

        icon.classList.remove('bi-eye-slash');
        icon.classList.add('bi-eye');
    }
}
</script>

</body>
</html>