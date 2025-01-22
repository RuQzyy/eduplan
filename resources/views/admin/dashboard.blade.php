<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap');

        .center-container {
            display: flex;
            justify-content: center;
            align-items: center;
            width: 100%;
            height: 100vh;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: rgb(220, 240, 240);
        }

        .gradient-header {
            background: linear-gradient(to right, rgb(23, 164, 206), rgb(15, 145, 130));
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .calendar-day {
            transition: transform 0.3s ease, background-color 0.3s ease;
        }

        .calendar-day:hover {
            transform: scale(1.1);
            background-color: rgb(15, 145, 130);
            color: white;
        }

        .welcome-image {
            filter: brightness(0.85);
            transition: filter 0.3s ease;
        }

        .welcome-image:hover {
            filter: brightness(1);
        }

        .permintaan-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
        }

        button,
        .calendar-day,
        .permintaan-card {
            transition: all 0.3s ease-in-out;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <header class="flex items-center justify-between gradient-header text-white p-4 shadow-md sticky top-0 z-50">
        <div class="flex items-center space-x-3">
            <img alt="Logo" class="h-12 rounded-full" src="{{ asset('img/maxresdefault.jpg') }}" />
            <h1 class="text-2xl font-bold">Eduplen Dashboard</h1>
        </div>
        <nav class="flex space-x-6">
            <a class="flex items-center text-white hover:text-gray-200" href="{{ url('admin/dashboard') }}">
                <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
            </a>
            <a class="flex items-center text-white hover:text-gray-200" href="{{ url('admin/ruangan') }}">
                <i class="fas fa-building mr-2"></i> Ruangan
            </a>
        </nav>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-sm">Log Out</button>
        </form>
    </header>

    <!-- Main Content -->
    <main class="p-10 space-y-10">
        <div class="grid grid-cols-3 md:grid-cols-1 lg:grid-cols-2 gap-8">

            <!-- Welcome Section -->
            <div class="relative bg-cover bg-center text-white rounded-xl shadow-lg overflow-hidden" style="background-image: url('{{ asset('img/orang.jpg') }}'); min-height: 300px;">
                <div class="bg-black bg-opacity-50 w-full h-full p-8 flex flex-col justify-center items-center md:items-start text-center md:text-left space-y-4">
                    <h1 class="text-4xl font-extrabold leading-tight">Selamat Datang di Dashboard EduPlan!</h1>
                    <p class="text-lg font-medium">
                        Kelola jadwal dengan mudah dan efisien menggunakan fitur lengkap kami.
                    </p>
                    <button class="bg-teal-600 hover:bg-teal-700 font-semibold px-6 py-3 rounded-lg shadow-md hover:shadow-lg transform hover:scale-105 transition duration-300">
                        Jelajahi Sekarang
                    </button>
                </div>
            </div>

            <!-- Calendar Section -->
            <div class="bg-white p-6 shadow-lg rounded-xl">
                <div class="text-center">
                <p id="current-time" class="text-lg font-semibold text-gray-600"></p>
                <p class="bg-teal-500 text-white inline-block px-3 py-1 rounded-lg text-sm mt-1" id="today-info"></p>

                </div>
                <div class="mt-6">
                    <p class="text-center text-2xl font-bold" id="month-year"></p>
                    <div class="grid grid-cols-7 gap-1 text-center mt-4 text-gray-600 font-medium">
                        <div>S</div>
                        <div>M</div>
                        <div>T</div>
                        <div>W</div>
                        <div>T</div>
                        <div>F</div>
                        <div>S</div>
                    </div>
                    <div id="calendar-days" class="grid grid-cols-7 gap-2 text-center mt-2"></div>
                </div>
            </div>
        </div>

        <!-- Class Requests Section -->
        <section class="bg-white p-6 shadow-lg rounded-xl">
            <h2 class="text-2xl font-bold mb-6">Permintaan Kelas</h2>
            @foreach($permintaan as $minta)
            <div class="space-y-4">
                <div class="flex items-center justify-between p-4 border rounded-lg hover:shadow-md transition duration-300 permintaan-card">
                    <div class="flex items-center space-x-3">
                        <i class="fas fa-user-tie text-teal-500"></i>
                        <span class="font-medium">{{ $minta->name }}</span>
                    </div>
                    <div class="text-gray-500">Ruangan: {{ $minta->nama_ruangan }} | {{ $minta->waktu_mulai }} - {{ $minta->waktu_selesai }} WIT</div>
                    <div class="flex items-center space-x-2">
                        <form action="{{ route('permintaan.terima', $minta->id_request) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="text-teal-500 hover:text-teal-700" type="submit">
                                <i class="fas fa-check-circle"></i> Terima
                            </button>
                        </form>
                        <form action="{{ route('permintaan.tolak', $minta->id_request) }}" method="POST">
                            @method('PUT')
                            @csrf
                            <button class="text-red-500 hover:text-red-700" type="submit">
                                <i class="fas fa-times-circle"></i> Tolak
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            @endforeach
        </section>

        <!-- Contact Section -->
        <footer class="text-white p-8 shadow-lg rounded-xl" style="background: linear-gradient(to right, rgb(23, 164, 206), rgb(15, 145, 130));">
            <div class="text-center space-y-4">
                <h2 class="font-extrabold text-2xl">Kelompok 3</h2>
                <p class="text-lg">Kami selalu siap membantu Anda!</p>
                <div class="flex justify-center items-center space-x-8">
                    <div class="text-center">
                        <i class="fas fa-envelope text-2xl"></i>
                        <p class="mt-2">Email:</p>
                        <a href="mailto:Kelompok3@gmail.com" class="underline">Kelompok3@gmail.com</a>
                    </div>
                    <div class="text-center">
                        <i class="fas fa-phone text-2xl"></i>
                        <p class="mt-2">Phone:</p>
                        <a href="tel:+628123445678990000" class="underline">0812-3445-6789</a>
                    </div>
                </div>
                <p class="text-sm text-gray-200 mt-4">&copy; 2025 Kelompok 3. All Rights Reserved.</p>
            </div>
        </footer>
    </main>

    <script>
        function generateCalendar() {
            const date = new Date();
            const month = date.getMonth();
            const year = date.getFullYear();
            const firstDay = new Date(year, month, 1).getDay();
            const daysInMonth = new Date(year, month + 1, 0).getDate();

            document.getElementById('month-year').innerText = date.toLocaleString('default', {
                month: 'long',
                year: 'numeric'
            });
            document.getElementById('today-info').innerText = `Hari Ini: ${date.toLocaleDateString()}`;


            const calendarDays = document.getElementById('calendar-days');
            calendarDays.innerHTML = '';

            for (let i = 0; i < firstDay; i++) {
                const emptyDiv = document.createElement('div');
                calendarDays.appendChild(emptyDiv);
            }

            for (let day = 1; day <= daysInMonth; day++) {
                const dayDiv = document.createElement('div');
                dayDiv.innerText = day;
                dayDiv.classList.add('py-2', 'rounded-lg', 'calendar-day');
                if (day === date.getDate()) {
                    dayDiv.classList.add('bg-teal-600', 'text-white', 'font-bold'); // Sesuaikan dengan tema biru kehijauan
                }

                calendarDays.appendChild(dayDiv);
            }
        }

        function updateTime() {
            const now = new Date();
            const timeString = now.toLocaleTimeString();
            document.getElementById('current-time').innerText = `Jam: ${timeString}`;
        }

        generateCalendar();
        setInterval(updateTime, 1000);
        updateTime();
    </script>
    </div>
</body>

</html>