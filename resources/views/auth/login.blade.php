<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - GoTrip Lampung</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
        }

        /* ================= CARD ================= */
        .login-card {
            background: #ffffff;
            border-radius: 14px;
            padding: 36px;
            box-shadow: 0 18px 40px rgba(0,0,0,.08);
            max-width: 420px;
            width: 100%;
        }

        /* ================= BRAND ================= */
        .brand-icon {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            background: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 26px;
            margin: 0 auto 14px;
        }

        /* ================= FORM ================= */
        .form-label {
            font-weight: 600;
            font-size: 14px;
        }

        .form-control {
            border-radius: 10px;
            padding: 12px 14px;
            font-size: 14px;
        }

        .form-control:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 .2rem rgba(13,110,253,.15);
        }

        /* ================= BUTTON ================= */
        .btn-login {
            height: 48px;
            border-radius: 10px;
            font-weight: 600;
            background-color: #0d6efd;
            border: none;
        }

        .btn-login:hover {
            background-color: #0b5ed7;
        }

        /* ================= PASSWORD ICON ================= */
        .toggle-password {
            cursor: pointer;
            color: #6c757d;
        }

        .toggle-password:hover {
            color: #0d6efd;
        }

        /* Password toggle button */
        .password-toggle {
            position: absolute;
            top: 50%;
            right: 14px;
            transform: translateY(-50%);
            background: transparent;
            border: none;
            padding: 0;
            height: 20px;
            width: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #6c757d;
            cursor: pointer;
        }

        .password-toggle:hover {
            color: #0d6efd;
        }

        /* ================= RIGHT PANEL ================= */
        .hero-overlay {
            background: linear-gradient(
                to bottom,
                rgba(13,110,253,.65),
                rgba(0,0,0,.75)
            );
        }
    </style>
</head>
<body>

<div class="container-fluid vh-100">
    <div class="row h-100">

        <!-- LEFT : LOGIN -->
        <div class="col-md-6 d-flex align-items-center justify-content-center">
            <div class="login-card">

                <div class="text-center mb-4">
                    <div class="brand-icon">
                        <i class="bi bi-globe2"></i>
                    </div>
                    <h4 class="fw-bold mb-1">GoTrip Lampung</h4>
                    <p class="text-muted mb-0">Admin Panel Login</p>
                </div>

                <form method="POST" action="{{ url('/login') }}">
                    @csrf

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email"
                               name="email"
                               class="form-control"
                               placeholder="admin@gotrip.id"
                               required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>

                        <div class="position-relative">
                            <input type="password"
                                name="password"
                                id="password"
                                class="form-control pe-5"
                                placeholder="••••••••"
                                required>

                            <button type="button"
                                    class="password-toggle"
                                    onclick="togglePassword()">
                                <i id="toggleIcon" class="bi bi-eye"></i>
                            </button>
                        </div>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label small" for="remember">
                                Ingat saya
                            </label>
                        </div>
                        <a href="#" class="small text-decoration-none">
                            Lupa password?
                        </a>
                    </div>

                    <button type="submit" class="btn btn-login w-100 text-white">
                        Login
                    </button>
                </form>

            </div>
        </div>

        <!-- RIGHT : IMAGE -->
        <div class="col-md-6 d-none d-md-block p-0">
            <div class="h-100 position-relative">
                <img src="{{ asset('images/banner3.jpeg') }}"
                     class="w-100 h-100"
                     style="object-fit: cover;">
                <div class="position-absolute top-0 start-0 w-100 h-100 hero-overlay
                            d-flex flex-column justify-content-center align-items-center
                            text-white text-center px-4">
                    <h1 class="fw-bold">Admin System</h1>
                    <p class="lead mb-0">GoTrip Lampung Management</p>
                </div>
            </div>
        </div>

    </div>
</div>

<script>
function togglePassword() {
    const input = document.getElementById("password");
    const icon = document.getElementById("toggleIcon");

    if (input.type === "password") {
        input.type = "text";
        icon.classList.replace("bi-eye", "bi-eye-slash");
    } else {
        input.type = "password";
        icon.classList.replace("bi-eye-slash", "bi-eye");
    }
}
</script>

</body>
</html>
