<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Riwayat Pemakaian Kelas</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.datatables.net/2.2.1/css/dataTables.dataTables.css" />
  <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
  <script src="https://cdn.datatables.net/2.2.1/js/dataTables.js"></script>
  <style>
    body {
      font-family: 'Inter', sans-serif;
      background-color: rgb(220, 240, 240);
    }
    .gradient-header {
      background: linear-gradient(to right, rgb(23, 164, 206), rgb(15, 145, 130));
      box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }
    .table-header {
      background-color: rgb(15, 145, 130);
      color: white;
    }
  </style>
</head>
<body class="bg-gray-100 min-h-screen">
  <!-- Navbar -->
  <header class="flex items-center justify-between gradient-header text-white p-4 shadow-md sticky top-0 z-50">
    <div class="flex items-center space-x-3">
      <img alt="Logo" class="h-12 rounded-full" src="{{ asset('img/maxresdefault.jpg') }}" />
      <h1 class="text-2xl font-bold">Eduplen Dashboard</h1>
    </div>
    <nav class="flex space-x-6">
      <a class="flex items-center text-white hover:text-gray-200" href="/admin/dashboard">
        <i class="fas fa-tachometer-alt mr-2"></i> Dashboard
      </a>
      <a class="flex items-center text-white hover:text-gray-200" href="/admin/ruangan">
        <i class="fas fa-building mr-2"></i> Ruangan
      </a>
    </nav>
    <form method="POST" action="{{ route('logout') }}">
      @csrf
      <button type="submit" class="bg-red-500 hover:bg-red-600 px-4 py-2 rounded text-sm">Log Out</button>
    </form>
  </header>

  <div class="container mx-auto mt-10 p-6">
    <h1 class="text-3xl font-bold text-gray-700 mb-6">Riwayat Pemakaian Kelas</h1>
    <div class="bg-white shadow-lg rounded-lg overflow-hidden">
      <div class="overflow-x-auto p-4">
        <table id="riwayatTable" class="w-full border-collapse display">
          <thead>
            <tr class="table-header">
              <th class="p-3 text-left">Nama Dosen</th>
              <th class="p-3 text-left">Nama Ruangan</th>
              <th class="p-3 text-left">Kelas</th>
              <th class="p-3 text-left">Tanggal</th>
              <th class="p-3 text-left">Waktu Mulai</th>
              <th class="p-3 text-left">Waktu Selesai</th>
            </tr>
          </thead>
          <tbody class="text-gray-600">
            @foreach($riwayat as $row)
            <tr class="border-b hover:bg-gray-100">
              <td class="p-3">{{ $row->name }}</td>
              <td class="p-3">{{ $row->nama_ruangan }}</td>
              <td class="p-3">{{ $row->kelas }}</td>
              <td class="p-3">{{ $row->tanggal_request }}</td>
              <td class="p-3">{{ $row->waktu_mulai }}</td>
              <td class="p-3">{{ $row->waktu_selesai }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    $(document).ready(function() {
      $('#riwayatTable').DataTable({
        responsive: true,
        paging: true,
        searching: true,
        ordering: true,
      });
    });
  </script>
</body>
</html>