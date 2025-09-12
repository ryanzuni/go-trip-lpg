<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - GoTrip Lampung</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container-fluid vh-100">
    <div class="row h-100">
        
        <!-- Kiri: Form Login -->
        <div class="col-md-6 d-flex align-items-center justify-content-center bg-light">
            <div class="w-75" style="max-width: 400px;">
                <div class="text-center mb-4">
                    <i class="bi bi-globe2 fs-1 text-primary"></i>
                    <h2 class="fw-bold mt-2">GoTrip Lampung</h2>
                    <p class="text-muted">Masuk untuk melanjutkan perjalananmu</p>
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

                <form method="POST" action="{{ url('/login') }}">
                    @csrf
                    <div class="form-floating mb-3">
                        <input type="email" name="email" class="form-control" id="email" placeholder="name@example.com" required autofocus>
                        <label for="email">Email</label>
                    </div>

                    <div class="form-floating mb-3 position-relative">
                        <input type="password" name="password" class="form-control" id="password" placeholder="Password" required>
                        <label for="password">Password</label>
                        <button type="button" class="btn btn-sm position-absolute top-50 end-0 translate-middle-y me-2 border-0 bg-transparent"
                            onclick="togglePassword()">
                            <i id="toggleIcon" class="bi bi-eye text-secondary"></i>
                        </button>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="remember">
                            <label class="form-check-label" for="remember">Ingat saya</label>
                        </div>
                        <a href="#" class="small text-decoration-none">Lupa password?</a>
                    </div>

                    <button type="submit" class="btn btn-primary w-100 py-2">Login</button>
                </form>

                <p class="text-center text-muted mt-4 mb-0">
                    Belum punya akun? <a href="#" class="text-decoration-none">Daftar sekarang</a>
                </p>
            </div>
        </div>

        <!-- Kanan: Gambar -->
        <div class="col-md-6 d-none d-md-block p-0">
            <div class="h-100 position-relative">
                <img src="https://source.unsplash.com/1200x900/?indonesia,travel" 
                     class="img-fluid w-100 h-100" style="object-fit: cover;">
                <div class="position-absolute top-0 start-0 w-100 h-100 bg-dark bg-opacity-50 d-flex flex-column justify-content-center align-items-center text-white text-center p-4">
                    <h1 class="fw-bold">Jelajahi Keindahan Nusantara</h1>
                    <p class="lead">Temukan destinasi impianmu bersama GoTrip Lampung</p>
                </div>
            </div>
        </div>

    </div>
</div>

<!-- Toggle Password -->
<script>
function togglePassword() {
    const passInput = document.getElementById("password");
    const toggleIcon = document.getElementById("toggleIcon");
    if (passInput.type === "password") {
        passInput.type = "text";
        toggleIcon.classList.remove("bi-eye");
        toggleIcon.classList.add("bi-eye-slash");
    } else {
        passInput.type = "password";
        toggleIcon.classList.remove("bi-eye-slash");
        toggleIcon.classList.add("bi-eye");
    }
}
</script>

</body>
</html>
