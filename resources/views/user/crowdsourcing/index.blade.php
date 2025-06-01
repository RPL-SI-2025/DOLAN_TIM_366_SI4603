<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Destinasi Saya</title>
  <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
  <div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-center mb-6">Destinasi yang Saya Submit</h1>
    
    @if(session('success'))
      <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
          <strong class="font-bold">Sukses!</strong>
          <span class="block sm:inline">{{ session('success') }}</span>
      </div>
    @endif

    @if($destinations->isEmpty())
      <p class="text-center text-gray-600">Belum ada destinasi yang diajukan.</p>
    @else
      <div class="overflow-x-auto">
        <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
          <thead class="bg-gray-200">
            <tr>
              <th class="px-4 py-2 text-left">Nama Destinasi</th>
              <th class="px-4 py-2 text-left">Lokasi</th>
              <th class="px-4 py-2 text-left">Status</th>
              <th class="px-4 py-2 text-left">Tanggal Dibuat</th>
            </tr>
          </thead>
          <tbody>
            @foreach($destinations as $destination)
              <tr class="border-b hover:bg-gray-100">
                <td class="px-4 py-2">{{ $destination->name }}</td>
                <td class="px-4 py-2">{{ $destination->location }}</td>
                <td class="px-4 py-2 capitalize">{{ $destination->status ?? 'pending' }}</td>
                <td class="px-4 py-2">{{ $destination->created_at->format('d M Y') }}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    @endif

    <div class="mt-4 text-center">
      <a href="{{ route('home') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">Kembali ke Home</a>
    </div>
  </div>
</body>
</html>