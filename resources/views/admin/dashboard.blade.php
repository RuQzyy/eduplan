<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
    <div class="w-full">
        <!-- Header -->
        <header class="flex items-center justify-between bg-gradient-to-r from-teal-500 to-cyan-600 text-white p-4 shadow-md sticky top-0 z-50">
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
        <main class="p-6 space-y-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Welcome Section -->
                <div class="col-span-2 bg-white shadow-md rounded-lg overflow-hidden">
                    <div class="relative h-64">
                        <img src="{{ asset('img/orang.jpg') }}" alt="Background" class="w-full h-full object-cover object-center">
                        <div class="absolute inset-0 bg-gradient-to-r from-black/50 to-transparent flex items-center p-6">
                            <div class="text-white">
                                <h1 class="text-2xl font-bold">Hello,</h1>
                                <p>Selamat datang admin di website Eduplen To-Do List</p>
                                <p>Penjadwalan Ruang Kelas</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Calendar Section -->
                <div class="bg-white p-6 shadow-md rounded-lg">
                    <div class="text-right">
                        <p id="current-date" class="text-sm font-semibold text-gray-500"></p>
                        <p class="bg-teal-500 text-white inline-block px-2 py-1 rounded text-xs mt-1" id="today-info"></p>
                    </div>
                    <div class="mt-4">
                        <p class="text-center text-xl font-bold" id="month-year"></p>
                        <div class="grid grid-cols-7 gap-1 text-center mt-2 text-gray-500">
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
            <section class="bg-white p-6 shadow-md rounded-lg">
                <h2 class="text-xl font-bold mb-4">Permintaan Kelas</h2>
                @foreach($permintaan as $minta)
                <div class="space-y-4">
                    <!-- Example Request -->
                    <div class="flex items-center justify-between p-4 border rounded hover:bg-gray-50">
                        <div class="flex items-center space-x-3">
                            <i class="fas fa-user-tie text-teal-500"></i>
                            <span class="font-medium">{{ $minta->name }}</span>
                        </div>
                        <div class="text-gray-500">Ruangan: {{ $minta->nama_ruangan }} | {{ $minta->waktu_mulai }} - {{ $minta->waktu_selesai }} WIT</div>
                        <div class="flex items-center space-x-2">
                            <form action="{{ route('permintaan.terima', $minta->id_request) }}" method="POST">
                                @method('PUT')
                                @csrf
                                <button class="text-green-500 hover:text-green-700" type="submit">
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
            <footer class="bg-teal-500 text-white p-6 shadow-md rounded-lg text-center">
                <h2 class="font-bold text-lg">Kelompok 3</h2>
                <p class="mt-2">Contact Us:</p>
                <p>Email: <a href="mailto:Kelompok3@gmail.com" class="underline">Kelompok3@gmail.com</a></p>
                <p>Phone: <a href="tel:+628123445678990000" class="underline">0812-3445-6789</a></p>
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
                document.getElementById('current-date').innerText = date.toLocaleDateString();
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
                    dayDiv.classList.add('py-2', 'rounded', 'hover:bg-teal-200');
                    if (day === date.getDate()) {
                        dayDiv.classList.add('bg-teal-500', 'text-white');
                    }
                    calendarDays.appendChild(dayDiv);
                }
            }

            generateCalendar();
        </script>
</body>

</html>