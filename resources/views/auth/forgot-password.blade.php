<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-family: 'Arial', sans-serif;
        }
        .card {
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
        }
        .btn-primary {
            background-color: #4A90E2;
            border: none;
            transition: 0.3s;
        }
        .btn-primary:hover {
            background-color: #357ABD;
        }
    </style>
</head>
<body>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="card p-4" style="max-width: 400px; width: 100%;">
            <h3 class="text-center mb-4 text-primary">Lupa Kata Sandi Anda?</h3>
            <p class="text-muted text-center">
            Tidak masalah. Cukup beri tahu kami alamat email Anda dan kami akan mengirimkan email berisi tautan pengaturan ulang kata sandi.
            </p>
            
            <!-- Session Status -->
            <div class="mb-3">
                <x-auth-session-status class="text-success" :status="session('status')" />
            </div>
            
            <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <!-- Email Address -->
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">Email</label>
                    <input id="email" type="email" name="email" class="form-control" :value="old('email')" required autofocus>
                    <x-input-error :messages="$errors->get('email')" class="text-danger mt-2" />
                </div>
                
                <div class="d-grid">
                    <button type="submit" class="btn btn-primary">
                        Email Password Reset Link
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
