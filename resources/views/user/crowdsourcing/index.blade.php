<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Destinasi Saya</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet">
</head>
           <x-navbar></x-navbar>
<body class="bg-gradient-to-br from-purple-100 via-white to-blue-100 min-h-screen">
    <div class="container mx-auto p-6 max-w-3xl">
        <div class="bg-white rounded-xl shadow-lg p-8">
            <h1 class="text-3xl font-extrabold text-purple-700 text-center mb-8 tracking-tight">Destinasi yang telah di Submit</h1>
            
            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-400 text-green-700 px-4 py-3 rounded mb-6 flex items-center" role="alert">
                        <svg class="w-6 h-6 mr-2 text-green-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                        </svg>
                        <div>
                            <strong class="font-bold">Sukses!</strong>
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                </div>
            @endif

 

            @if($destinations->isEmpty())
                @if(auth()->check() && in_array(auth()->user()->role, ['admin', 'super_admin']))
                    <p class="text-center text-gray-500 bold py-8">Kamu admin bang bukan member 🤓 .</p>
                @else
                    <p class="text-center text-gray-500 italic py-8">Belum ada destinasi yang diajukan.</p>
                @endif
            @else
                <div class="overflow-x-auto rounded-lg border border-gray-200">
                    <table class="min-w-full bg-white">
                        <thead class="bg-gradient-to-r from-purple-200 to-blue-200">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Nama Destinasi</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Lokasi</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Status</th>
                                <th class="px-4 py-3 text-left font-semibold text-gray-700">Tanggal Dibuat</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($destinations as $destination)
                                <tr class="border-b last:border-b-0 hover:bg-purple-50 transition">
                                    <td class="px-4 py-3">{{ $destination->name }}</td>
                                    <td class="px-4 py-3">{{ $destination->location }}</td>
                                    <td class="px-4 py-3">
                                        <span class="inline-block px-2 py-1 rounded text-xs font-medium
                                            @if($destination->status === 'approved') bg-green-100 text-green-700
                                            @elseif($destination->status === 'rejected') bg-red-100 text-red-700
                                            @else bg-yellow-100 text-yellow-700 @endif
                                        ">
                                            {{ $destination->status ?? 'pending' }}
                                        </span>
                                    </td>
                                    <td class="px-4 py-3 text-gray-500">{{ $destination->created_at->format('d M Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif

            <div class="mt-8 text-center">
                <a href="{{ route('user.destinations.create') }}" class="inline-block bg-gradient-to-r from-purple-500 to-blue-500 text-white px-6 py-3 rounded-lg shadow hover:from-purple-600 hover:to-blue-600 transition font-semibold text-lg">
                    + Request Destinasi
                </a>
            </div>
        </div>
    </div>
</body>
</html>