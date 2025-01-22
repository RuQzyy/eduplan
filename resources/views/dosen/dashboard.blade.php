<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Eduplen To-Do List</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <script>
    document.addEventListener("DOMContentLoaded", function() {
      const dateEl = document.getElementById("current-date");
      const timeEl = document.getElementById("current-time");

      function updateDateTime() {
        const now = new Date();
        dateEl.textContent = now.toLocaleDateString('en-US', {
          weekday: 'long',
          year: 'numeric',
          month: 'long',
          day: 'numeric'
        });
        timeEl.textContent = now.toLocaleTimeString();
      }

      setInterval(updateDateTime, 1000); // Update every second
      updateDateTime(); // Initialize on page load
    });
  </script>
</head>

<body class="bg-gradient-to-r from-blue-100 to-purple-200 min-h-screen">
  <!-- Fixed Navbar -->
  <header class="fixed top-0 left-0 right-0 bg-gradient-to-r from-blue-600 to-purple-600 shadow-lg p-4 flex justify-between items-center text-white z-50">
    <img alt="Logo" class="h-12 rounded-full" src="{{ asset('img/maxresdefault.jpg') }}" />
    <nav class="flex space-x-6">
      <!-- Link Dashboard -->
      <a class="flex items-center space-x-2 hover:text-yellow-400" href="/dosen/dashboard">
        <i class="fas fa-calendar-alt"></i>
        <span>Dashboard</span>
      </a>
      <!-- Link Ruangan -->
      <a class="flex items-center space-x-2 hover:text-yellow-400" href="/dosen/ruangan">
        <i class="fas fa-door-open"></i>
        <span>Ruangan</span>
      </a>
    </nav>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-sm">Log Out</button>
    </form>
  </header>
  <!-- Add padding to avoid overlapping fixed navbar -->
  <div class="pt-20"></div>
  <main class="p-8">
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
      <!-- Greeting Section -->
<div class="lg:col-span-2 relative bg-white rounded-xl shadow-2xl overflow-hidden transform hover:scale-105 transition-all duration-500">
  <!-- Background Image with Parallax Effect -->
  <div class="relative w-full h-[350px]">
    <img src="{{ asset('img/progremer.jpeg') }}" alt="Welcome Image" class="absolute inset-0 w-full h-full object-cover opacity-80">
    <div class="absolute inset-0 bg-gradient-to-r from-black/60 to-transparent"></div>
  </div>
  
  <!-- Overlay Text -->
  <div class="absolute inset-0 flex flex-col justify-center items-start p-10 text-white">
    <h1 class="text-5xl font-extrabold drop-shadow-lg animate-fadeInUp">Hello, {{ Auth::user()->name }}!</h1>
    <p class="text-lg mt-4 drop-shadow-md animate-fadeInUp delay-100">Selamat datang di platform <span class="text-yellow-400 font-semibold">Eduplen To-Do List</span></p>
    <p class="mt-2 text-md text-gray-300 animate-fadeInUp delay-200">Efisien dalam mengelola jadwal ruang kelas dengan mudah.</p>
    <a href="/dosen/ruangan" class="mt-6 bg-yellow-400 hover:bg-yellow-500 text-black font-semibold px-6 py-3 rounded-lg shadow-lg animate-fadeInUp delay-300 transition-all">
      Jelajahi Ruangan
    </a>
  </div>
</div>


      <!-- Real-Time Calendar -->
      <div class="bg-white p-6 rounded-xl shadow-2xl text-center">
        <h2 class="text-2xl font-bold text-blue-700">Calendar</h2>
        <p id="current-date" class="text-gray-600 mt-4"></p>
        <p id="current-time" class="text-blue-600 text-lg font-semibold mt-2"></p>
        <div class="mt-6 grid grid-cols-7 gap-2 text-center text-gray-800 font-medium">
          <div>S</div>
          <div>M</div>
          <div>T</div>
          <div>W</div>
          <div>T</div>
          <div>F</div>
          <div>S</div>
          <!-- Dates -->
          <div class="text-gray-500">1</div>
          <div>2</div>
          <div>3</div>
          <div>4</div>
          <div>5</div>
          <div>6</div>
          <div>7</div>
          <div>8</div>
          <div>9</div>
          <div>10</div>
          <div>11</div>
          <div>12</div>
          <div>13</div>
          <div>14</div>
          <div>15</div>
          <div>16</div>
          <div>17</div>
          <div>18</div>
          <div>19</div>
          <div>20</div>
          <div>21</div>
          <div>22</div>
          <div>23</div>
          <div>24</div>
          <div>25</div>
          <div>26</div>
          <div>27</div>
          <div>28</div>
          <div>29</div>
          <div>30</div>
        </div>
      </div>
    </div>
    <!-- Class Schedule Section -->
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 mt-8">
      <!-- Kelas Saya -->
      <div class="lg:col-span-2 bg-white p-6 rounded-xl shadow-2xl">
        <h2 class="text-2xl font-bold text-blue-700">Kelas Saya</h2>
        <div class="mt-6 p-4 border rounded-xl flex items-center bg-gray-100 shadow-sm">
          <i class="fas fa-info-circle text-blue-700 text-2xl mr-4"></i>
          <div>
            @php
            $hari = date('Y-m-d');
            @endphp
            <p class="font-bold text-gray-800">{{ Auth::user()->name }}</p>
            @foreach($jadwal as $row)
            @if($row->id_dosen == Auth::user()->id)
            <p class="text-gray-600">
              @if($row->tanggal_request == $hari)
              {{ $row->nama_ruangan }} | {{ $row->waktu_mulai }} - {{ $row->waktu_selesai }}
              @endif
            </p>
            @endif
            @endforeach
          </div>
        </div>
      </div>
      <!-- Contact Us Section -->
      <div class="bg-white p-6 rounded-xl shadow-2xl">
        <div class="flex items-center">
          <img alt="Kelompok 3 Logo" class="h-16 rounded-full shadow-lg" src="{{ asset('img/maxresdefault.jpg') }}" />
          <div class="ml-6">
            <h2 class="text-2xl font-bold text-blue-700">Kelompok 3</h2>
          </div>
        </div>
        <div class="mt-6">
          <h3 class="font-bold text-blue-700">Contact Us :</h3>
          <p class="text-gray-600">Email : Kelompok3@gmail.com</p>
          <p class="text-gray-600">No TlP : 0812344567890000</p>
        </div>
      </div>
    </div>
  </main>
</body>

</html>