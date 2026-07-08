<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - Microlearning</title>
    <!-- Google Fonts Poppins -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,400;1,600&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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

        .register-card {
            background: #ffffff;
            border: 1px solid rgba(226, 232, 240, 0.8);
            border-radius: 24px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.05), 0 8px 10px -6px rgba(0, 0, 0, 0.05) !important;
        }

        .register-card .form-control {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #1e293b;
            font-size: 0.9rem;
            padding: 0.6rem 0.9rem;
            border-radius: 10px;
            font-family: 'Poppins', sans-serif;
        }

        .register-card .form-control:focus {
            box-shadow: 0 0 0 4px rgba(59, 130, 246, 0.1);
            border-color: #3b82f6;
        }

        .register-card .form-label {
            color: #475569;
            font-weight: 500;
            font-size: 0.85rem;
            margin-bottom: 0.5rem;
        }

        .register-card .btn-primary {
            background: linear-gradient(135deg, #2563eb, #4f46e5);
            border: none;
            box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
            color: #ffffff;
            font-weight: 500;
            border-radius: 10px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .register-card .btn-primary:hover {
            background: linear-gradient(135deg, #1d4ed8, #4338ca);
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(37, 99, 235, 0.3);
        }

        .register-brand {
            width: 72px;
            height: 72px;
            border-radius: 18px;
            overflow: hidden;
            border: 1px solid #e2e8f0;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
            display: flex;
            align-items: center;
            justify-content: center;
            margin: auto;
        }

        .register-brand img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .register-footer p {
            color: #64748b;
            font-size: 0.85rem;
        }

        .register-footer a {
            color: #2563eb;
            text-decoration: none;
            font-weight: 600;
            font-size: 0.875rem;
            transition: color 0.15s ease;
        }

        .register-footer a:hover {
            color: #1d4ed8;
            text-decoration: underline;
        }
        .input-group .btn {
            background: #ffffff;
            border: 1px solid #cbd5e1;
            color: #64748b;
            border-top-right-radius: 10px;
            border-bottom-right-radius: 10px;
            padding: 0.6rem 0.9rem;
        }

        .input-group .btn:hover {
            background: #f8fafc;
            color: #1e293b;
        }
        .text-muted-custom {
            color: #64748b;
            font-size: 0.85rem;
            line-height: 1.5;
        }
    </style>
</head>

<body>

<div class="container d-flex justify-content-center align-items-center py-5 min-vh-100">

    <div class="card register-card p-4 shadow-lg" style="width: 460px; border: none;">

        <div class="text-center mb-4">

            <div class="register-brand mb-3">
                <img src="{{ asset('logo.jpg') }}" alt="Logo">
            </div>

            <h3 class="fw-bold text-slate-900" style="font-size: 1.5rem;">
                Buat Akun Baru
            </h3>

            <p class="text-muted-custom mb-0">
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
                    placeholder="Masukkan nama lengkap"
                    required>
            </div>

            <div class="mb-3">
                <label class="form-label">
                    Email
                </label>

                <input
                    type="email"
                    name="email"
                    class="form-control"
                    value="{{ old('email') }}"
                    placeholder="Masukkan email"
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
                        placeholder="Masukkan password"
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
                        placeholder="Masukkan ulang password"
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
                class="btn btn-primary w-100 py-2.5 mt-2">
                Daftar
            </button>

        </form>

        <div class="text-center mt-4 register-footer">

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