<!DOCTYPE html>
<html lang="en">
@php
$ruang = DB::table('ruangan')->where('status_ruangan', '=', 'Tersedia')->get();
$ruangan = DB::table('ruangan')->get();
@endphp

<head>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Room Booking</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"
    rel="stylesheet" />
  <style>
    .custom-blue {
      background-color: #7b83b4;
    }

    .custom-tahan {
      background-color: #051d87;
    }

    .hover-effect:hover {
      transform: scale(1.05);
      transition: transform 0.2s;
    }

    /* Menambahkan gradasi latar belakang untuk halaman */
    body {
      background: linear-gradient(135deg, #7b83b4, #3a4d81);
    }

    .modal {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      z-index: 50;
      background: white;
      border-radius: 10px;
      padding: 20px;
      box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
    }

    .ruangan.hover-effect:hover {
      background-color: grey;
    }

    .modal-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.5);
      z-index: 40;
    }

    .hidden {
      display: none;
    }
  </style>
</head>

<body class="bg-gradient-to-br from-gray-100 via-gray-200 to-gray-300">
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

  <div class="container mx-auto p-4 mt-20">
    <!-- Room Status -->
    <div class="bg-[#7B83B4] p-4 rounded-lg mb-6">
      <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 lg:grid-cols-7 gap-2">
        @foreach ($ruangan as $room)
        @if($room->status_ruangan == 'Tersedia')
        <button class="room-button bg-white p-2 rounded hover:bg-gray-600"">{{ $room->nama_ruangan }}</button>
        @elseif($room->status_ruangan == 'Tidak Tersedia')
        <button class=" room-button bg-red-500 p-2 rounded hover:bg-gray-600">{{ $room->nama_ruangan }}</button>
        @endif
        @endforeach
      </div>
    </div>


    <!-- Room Details -->
    <div class=" flex justify-center">
      <div class="custom-blue p-6 mt-6 rounded-lg w-full max-w-lg shadow-md text-white">
        <div class="flex justify-between items-center mb-4">
          <div class="flex items-center space-x-2">
            <div class="w-4 h-4 bg-white border border-gray-400"></div>
            <span>Tersedia</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-4 h-4 bg-gray-400"></div>
            <span>Tahan</span>
          </div>
          <div class="flex items-center space-x-2">
            <div class="w-4 h-4 bg-red-500"></div>
            <span>Diambil</span>
          </div>
        </div>
        <div class="flex justify-center space-x-4">
          <button id="tahanButton" class="custom-tahan text-white px-4 py-2 rounded hover-effect">Tahan</button>
          <button id="ambilButton" class="bg-green-500 text-white px-4 py-2 rounded hover-effect">Ambil</button>
        </div>
      </div>
    </div>

    <!-- Notes -->
    <div class="custom-blue p-6 mt-6 rounded-lg shadow-md">
      <div class="text-white text-center font-bold mb-4">Catatan</div>
      <textarea class="w-full h-32 p-3 border border-gray-400 rounded focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
    </div>
  </div>

  <!-- Modal -->
  <div id="modal" class="hidden fixed inset-0 flex items-center justify-center z-50">
    <div class="modal-overlay absolute inset-0 bg-black opacity-50"></div>
    <div class="modal bg-white rounded-lg p-6 shadow-lg w-full max-w-md">
      <h2 class="text-xl font-bold mb-4">Masukkan Detail Pemesanan</h2>
      <form action="{{ route('permintaan.store') }}" method="POST">
        @csrf
        <div class="mb-4">
          <!-- <label for="name" class="block text-gray-700">id_dosen</label> -->
          <input id="name" name="id_dosen" value="{{ Auth::user()->id }}" type="text" class="w-full border border-gray-400 p-2 rounded" hidden />
        </div>
        <div class="mb-4">
          <label for="name" class="block text-gray-700">Pilih Ruangan</label>
          <select name="id_ruangan" id="" class="w-full border border-gray-400 p-2 rounded" />
          <option value=""></option>
          @foreach ($ruang as $ruangan)
          <option value="{{ $ruangan->id_ruangan }}">{{ $ruangan->nama_ruangan }}</option>
          @endforeach
          </select>
        </div>
        <div class="mb-4">
          <label for="start-date" class="block text-gray-700">Waktu Mulai</label>
          <input id="start-date" name="waktu_mulai" type="datetime-local" class="w-full border border-gray-400 p-2 rounded" />
        </div>
        <div class="mb-4">
          <label for="end-date" class="block text-gray-700">Waktu Berakhir</label>
          <input id="end-date" name="waktu_selesai" type="datetime-local" class="w-full border border-gray-400 p-2 rounded" />
        </div>
        <div class="flex justify-end space-x-2">
          <button type="button" id="cancelButton" class="bg-gray-500 text-white px-4 py-2 rounded">Batal</button>
          <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const ambilButton = document.getElementById('ambilButton'); // Tombol "Ambil"
      const tahanButton = document.getElementById('tahanButton'); // Tombol "Tahan"
      const modal = document.getElementById('modal'); // Modal
      const cancelButton = document.getElementById('cancelButton'); // Tombol "Batal"
      const roomButtons = document.querySelectorAll('.room-button'); // Tombol ruangan

      let selectedRoom = null; // Ruangan yang dipilih

      // Klik tombol ruangan untuk memilih ruangan
      roomButtons.forEach(button => {
        button.addEventListener('click', () => {
          // Reset semua tombol ke warna awal
          roomButtons.forEach(btn => {
            btn.classList.remove('bg-gray-400', 'text-white'); // Hapus kelas tombol dipilih
            btn.classList.add('bg-white', 'text-black'); // Kembalikan ke gaya awal
          });

          // Tambahkan kelas abu-abu ke tombol yang dipilih
          button.classList.remove('bg-white', 'text-black'); // Hapus kelas awal
          button.classList.add('bg-gray-400', 'text-white'); // Tambahkan kelas abu-abu dan teks putih

          // Simpan ruangan yang dipilih
          selectedRoom = button.textContent.trim(); // Ambil nama ruangan
          console.log('Room selected:', selectedRoom);
        });
      });

      // Klik tombol "Ambil"
      ambilButton.addEventListener('click', () => {
        if (selectedRoom) {
          modal.classList.remove('hidden'); // Tampilkan modal
        } else {
          alert('Pilih ruangan terlebih dahulu!'); // Validasi jika ruangan belum dipilih
        }
      });

      // Klik tombol "Tahan"
      tahanButton.addEventListener('click', () => {
        if (selectedRoom) {
          modal.classList.remove('hidden'); // Tampilkan modal
        } else {
          alert('Pilih ruangan terlebih dahulu!'); // Validasi jika ruangan belum dipilih
        }
      });

      // Klik tombol "Batal"
      cancelButton.addEventListener('click', () => {
        modal.classList.add('hidden'); // Sembunyikan modal
      });
    });

    // Tambahan untuk pengiriman data ke backend
    document.addEventListener('DOMContentLoaded', () => {
      const saveButton = document.querySelector('.save-button'); // Tombol "Simpan" di modal
      const nameInput = document.getElementById('name'); // Input Nama
      const startDateInput = document.getElementById('start-date'); // Input Tanggal Mulai
      const endDateInput = document.getElementById('end-date'); // Input Tanggal Berakhir

      saveButton.addEventListener('click', (event) => {
        event.preventDefault(); // Mencegah pengiriman form default

        // Validasi form
        if (!nameInput.value || !startDateInput.value || !endDateInput.value) {
          alert('Semua kolom harus diisi!');
          return;
        }

        if (!selectedRoom) {
          alert('Pilih ruangan terlebih dahulu!');
          return;
        }

        // Data yang akan dikirim ke backend
        const requestData = {
          id_ruangan: selectedRoom, // Ruangan yang dipilih
          id_dosen: 1, // Ganti dengan ID dosen yang login (opsional, sesuaikan backend)
          waktu_mulai: startDateInput.value, // Tanggal Mulai dari modal
          waktu_selesai: endDateInput.value, // Tanggal Berakhir dari modal
          status_request: ambilButton.classList.contains('active') ? 'ambil' : 'tahan', // Status dari tombol
        };

        // Kirim data ke backend menggunakan fetch API
        fetch('/ruangan/request', {
            method: 'POST',
            headers: {
              'Content-Type': 'application/json',
              'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content, // Token CSRF Laravel
            },
            body: JSON.stringify(requestData),
          })
          .then((response) => {
            if (!response.ok) {
              throw new Error('Gagal menyimpan data');
            }
            return response.json();
          })
          .then((result) => {
            alert(result.message || 'Berhasil menyimpan data'); // Pesan sukses dari backend
            modal.classList.add('hidden'); // Sembunyikan modal
            location.reload(); // Reload halaman untuk melihat pembaruan (opsional)
          })
          .catch((error) => {
            console.error('Error:', error);
            alert('Terjadi kesalahan saat menyimpan data.');
          });
      });
    });
  </script>


</body>

</html>