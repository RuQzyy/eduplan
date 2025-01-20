<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Eduplan</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 flex items-center justify-center h-screen">
    <div class="bg-white rounded-lg shadow-2xl flex overflow-hidden w-full max-w-5xl">
        <!-- Kiri: Selamat Datang -->
        <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-700 to-purple-700 text-white flex flex-col justify-center items-center p-8">
            <img src="{{ asset('img/stikom.png') }}" alt="Logo ITB STIKOM Ambon" class="h-24 mb-4 animate-bounce">
            <h1 class="text-3xl font-extrabold mb-4 text-center">SELAMAT DATANG DI <span class="text-yellow-400">EDUPLAN</span></h1>
            <p class="text-center text-lg font-light mb-6">To-Do List Penjadwalan Dosen dan Ruang Kelas</p>
            <img src="{{ asset('img/maxresdefault.jpg') }}" alt="Eduplan Illustration" class="rounded-lg shadow-lg w-3/4 hover:scale-105 transition transform duration-300">
        </div>

        <!-- Kanan: Form Login -->
        <div class="w-full md:w-1/2 bg-gray-50 flex justify-center items-center p-10">
            <form method="POST" action="{{ route('login') }}" class="w-full max-w-md">
                @csrf

                <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Login</h2>

                <!-- Menampilkan Session Status -->
                @if (session('status'))
                    <div class="mb-4 text-sm text-green-600">
                        {{ session('status') }}
                    </div>
                @endif

                <!-- Input Email -->
                <div class="mb-4">
                    <input
                        type="email"
                        name="email"
                        id="email"
                        class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Email Address"
                        value="{{ old('email') }}"
                        required
                        autofocus
                        autocomplete="username"
                    />
                    @error('email')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Input Password -->
                <div class="relative mb-4">
                    <input
                        type="password"
                        name="password"
                        id="password"
                        class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500"
                        placeholder="Password"
                        required
                        autocomplete="current-password"
                    />
                    <button type="button" onclick="togglePassword()" class="absolute right-4 top-1/2 transform -translate-y-1/2 text-gray-500">
                        <i class="fas fa-eye"></i>
                    </button>
                    @error('password')
                        <span class="text-red-600 text-sm">{{ $message }}</span>
                    @enderror
                </div>

                <!-- Remember Me -->
                <div class="flex items-center mb-4">
                    <input
                        id="remember_me"
                        type="checkbox"
                        class="rounded border-gray-300 text-blue-600 focus:ring focus:ring-indigo-500"
                        name="remember"
                    />
                    <label for="remember_me" class="ml-2 text-sm text-gray-600">Remember me</label>
                </div>

                <!-- Tombol Login -->
                <div>
                    <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transform transition hover:scale-105">
                        LOGIN
                    </button>
                </div>

                <!-- Lupa Password -->
                <div class="text-center mt-4">
                    @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-red-500 text-sm hover:underline">
                            Lupa Password?
                        </a>
                    @endif
                </div>
            </form>
        </div>
    </div>

    <script>
        function togglePassword() {
            const password = document.getElementById('password');
            const eyeIcon = event.target;
            if (password.type === 'password') {
                password.type = 'text';
                eyeIcon.classList.remove('fa-eye');
                eyeIcon.classList.add('fa-eye-slash');
            } else {
                password.type = 'password';
                eyeIcon.classList.remove('fa-eye-slash');
                eyeIcon.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>
