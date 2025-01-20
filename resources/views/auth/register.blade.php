<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen flex items-center justify-center">
    <div class="w-full max-w-5xl flex flex-col md:flex-row bg-white shadow-2xl rounded-lg overflow-hidden">
        <!-- Left Section: Background with Image and Welcome Text -->
        <div class="w-full md:w-1/2 bg-gradient-to-br from-blue-700 to-purple-700 text-white flex flex-col justify-center items-center p-8">
        <img src="{{ asset('img/stikom.png') }}" alt="Logo" class="w-32 h-32 mb-6 animate-bounce">
            <h1 class="text-3xl font-extrabold mb-4 text-center">Selamat Datang di <span class="text-yellow-400">EduPlan</span></h1>
            <p class="text-center text-lg font-light mb-6">To-Do List Penjadwalan Dosen dan Ruang Kelas</p>
            <img src="{{ asset('img/maxresdefault.jpg') }}" alt="Background" class="rounded-lg shadow-lg w-3/4 hover:scale-105 transition transform duration-300">
        </div>

        <!-- Right Section: Register Form -->
        <div class="w-full md:w-1/2 bg-gray-50 flex justify-center items-center p-10">
            <form method="POST" action="{{ route('register') }}" class="w-full max-w-md">
                @csrf
                <h2 class="text-3xl font-extrabold text-gray-800 mb-6 text-center">Registrasi Akun</h2>

                <!-- Role Selection -->
                <div class="mb-4">
                    <label for="role" class="block text-sm font-medium text-gray-700">Role</label>
                    <select id="role" name="role" class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="" disabled selected>Pilih Role Anda</option>
                        <option value="admin">Admin</option>
                        <option value="dosen">Dosen</option>
                    </select>
                    <p class="text-sm text-red-500 mt-2">@error('role') {{ $message }} @enderror</p>
                </div>

                <!-- Name -->
                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700">Name</label>
                    <input id="name" name="name" type="text" class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required autofocus autocomplete="name">
                    <p class="text-sm text-red-500 mt-2">@error('name') {{ $message }} @enderror</p>
                </div>

                <!-- Email -->
                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                    <input id="email" name="email" type="email" class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required autocomplete="username">
                    <p class="text-sm text-red-500 mt-2">@error('email') {{ $message }} @enderror</p>
                </div>

                <!-- Password -->
                <div class="mb-4">
                    <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                    <input id="password" name="password" type="password" class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required autocomplete="new-password">
                    <p class="text-sm text-red-500 mt-2">@error('password') {{ $message }} @enderror</p>
                </div>

                <!-- Confirm Password -->
                <div class="mb-4">
                    <label for="password_confirmation" class="block text-sm font-medium text-gray-700">Confirm Password</label>
                    <input id="password_confirmation" name="password_confirmation" type="password" class="block w-full mt-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500" required autocomplete="new-password">
                    <p class="text-sm text-red-500 mt-2">@error('password_confirmation') {{ $message }} @enderror</p>
                </div>

                <!-- Submit Button -->
                <div class="flex items-center justify-between mt-6">
                    <a href="{{ route('login') }}" class="text-sm text-blue-600 hover:underline">Already registered?</a>
                    <button type="submit" class="bg-gradient-to-r from-blue-600 to-indigo-600 hover:from-blue-700 hover:to-indigo-700 text-white font-bold py-2 px-4 rounded-lg shadow-md transform transition hover:scale-105">
                        Register
                    </button>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
