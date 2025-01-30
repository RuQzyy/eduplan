<html lang="en">
@php
$ruang = DB::table('ruangan')->where('status_ruangan', '=', 'Tersedia')->get();
$ruangan = DB::table('ruangan')->get();
@endphp

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>
        Dashboard
    </title>
    <script src="https://cdn.tailwindcss.com">
    </script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
</head>

<body class="bg-gray-100">
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
            <a class="flex items-center text-white hover:text-gray-200" href="{{ route('admin.riwayat') }}">
                <i class="fas fa-tachometer-alt mr-2"></i> Riwayat Kelas
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
    <div class="container mx-auto p-4 mt-20">
        <!-- Room Status -->
        <div class="bg-[#7B83B4] p-4 rounded-lg mb-6">
            <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-7 gap-2">
                @foreach ($ruangan as $room)
                <div class="w-full">
                    @if($room->status_ruangan == 'Tersedia')
                    <button class="room-button w-full bg-white p-2 rounded hover:bg-gray-600 text-center">{{ $room->nama_ruangan }}</button>
                    @elseif($room->status_ruangan == 'Tidak Tersedia')
                    <form action="{{ route('ruangan.update', $room->id_ruangan) }}" method="POST">
                        @method('PUT')
                        @csrf
                        <button onclick="return confirm('Apakah anda yakin ingin mengakhiri kelas ini?')" class="room-button w-full bg-red-500 p-2 rounded hover:bg-gray-600 text-center">{{ $room->nama_ruangan }}</button>
                    </form>
                    @endif
                </div>
                @endforeach
            </div>
        </div>
        <!-- Status Section -->
        <div class="bg-[#7B83B4] p-4 rounded-lg mb-6">
            <div class="flex justify-center space-x-8">
                <div class="flex items-center">
                    <div class="bg-white w-4 h-4 rounded mr-2">
                    </div>
                    <span class="text-white">
                        Tersedia
                    </span>
                </div>
                <div class="flex items-center">
                    <div class="bg-gray-400 w-4 h-4 rounded mr-2">
                    </div>
                    <span class="text-white">
                        Tahan
                    </span>
                </div>
                <div class="flex items-center">
                    <div class="bg-red-500 w-4 h-4 rounded mr-2">
                    </div>
                    <span class="text-white">
                        Tidak Tersedia
                    </span>
                </div>
            </div>
        </div>
    </div>
    @include('sweetalert::alert')
</body>

</html>