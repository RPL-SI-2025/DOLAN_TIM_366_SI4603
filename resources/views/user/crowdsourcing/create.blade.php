<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Destinasi Baru</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2/dist/tailwind.min.css" rel="stylesheet">
</head>
<x-navbar></x-navbar>



<body class="bg-gray-50">
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-xl max-w-4xl mt-10">
        <h2 class="text-2xl font-semibold text-indigo-600 text-center">Tambah Destinasi Baru</h2>
        <p class="text-gray-600 mb-6 text-center">
            Silakan lengkapi formulir di bawah ini untuk mengajukan destinasi wisata baru. Permintaan Anda akan diproses dan menunggu persetujuan dari admin sebelum ditampilkan di sistem.
        </p>

        @if ($errors->any())
            <div class="bg-red-100 border-l-4 border-red-500 text-red-700 p-4 mb-6" role="alert">
                <p class="font-bold">Terjadi kesalahan:</p>
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif


<form action="{{ route('user.destinations.store') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <!-- Form fields -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div class="flex flex-col">
                        <label for="name" class="text-sm font-semibold text-gray-700 mb-1">Nama Destinasi</label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" required 
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>

                    <div class="flex flex-col">
                        <label for="location" class="text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                        <input type="text" id="location" name="location" value="{{ old('location') }}" required 
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>

                    <div class="flex flex-col">
                        <label for="description" class="text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="description" name="description" rows="4" required 
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('description') }}</textarea>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="tour_includes" class="text-sm font-semibold text-gray-700 mb-1">Fasilitas & Fitur Tour</label>
                        <textarea id="tour_includes" name="tour_includes" rows="4" 
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                            placeholder="Contoh: Air terjun indah dan memukau, ada kolam renang untuk anak, dll">{{ old('tour_includes') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Deskripsi lengkap tentang apa yang disediakan di lokasi wisata</p>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="flex flex-col">
                        <label for="image" class="text-sm font-semibold text-gray-700 mb-1">Gambar Utama</label>
                        <input type="file" id="image" name="image" accept="image/*" required
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                            onchange="previewImage(event)">
                        <img id="image-preview" class="mt-3 rounded shadow max-h-40 hidden" alt="Preview">
                    </div>

                    <div class="flex flex-col">
                        <label for="additional_images" class="text-sm font-semibold text-gray-700 mb-1">Gambar Tambahan</label>
                        <input type="file" id="additional_images" name="additional_images[]" accept="image/*" multiple
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                            onchange="previewAdditionalImages(event)">
                        <div id="additional-images-preview" class="mt-3 flex flex-wrap gap-2"></div>
                    </div>
                </div>
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-3 bg-green-500 text-white font-semibold rounded-lg transition hover:bg-green-600 focus:ring-2 focus:ring-green-300">
                    Tambah Destinasi
                </button>
            </div>
        </form>
    </div>

    <script>
        function previewImage(event) {
            const reader = new FileReader();
            reader.onload = function() {
                const imagePreview = document.getElementById('image-preview');
                imagePreview.src = reader.result;
                imagePreview.classList.remove('hidden');
            }
            reader.readAsDataURL(event.target.files[0]);
        }

        function previewAdditionalImages(event) {
            const previewContainer = document.getElementById('additional-images-preview');
            previewContainer.innerHTML = '';
            
            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function() {
                    const imgElement = document.createElement('img');
                    imgElement.src = reader.result;
                    imgElement.classList.add('rounded', 'shadow', 'max-h-24');
                    previewContainer.appendChild(imgElement);
                }
                reader.readAsDataURL(file);
            });
        }

        document.addEventListener('DOMContentLoaded', function() {
            const hasTicketSelect = document.getElementById('has_ticket');
            const priceInput = document.getElementById('price');
            const stockInput = document.getElementById('stock');
            const tourPaymentsInput = document.getElementById('tour_payments');
            
            function toggleTicketFields() {
                const hasTicket = hasTicketSelect.value === '1';
                
                priceInput.disabled = !hasTicket;
                stockInput.disabled = !hasTicket;
                tourPaymentsInput.disabled = !hasTicket;
                
                if (!hasTicket) {
                    priceInput.classList.add('bg-gray-100');
                    stockInput.classList.add('bg-gray-100');
                    tourPaymentsInput.classList.add('bg-gray-100');
                    
                    priceInput.value = "0";
                    stockInput.value = "0";
                    tourPaymentsInput.value = "";
                    
                    tourPaymentsInput.placeholder = "Tidak tersedia untuk destinasi tanpa tiket";
                } else {
                    priceInput.classList.remove('bg-gray-100');
                    stockInput.classList.remove('bg-gray-100');
                    tourPaymentsInput.classList.remove('bg-gray-100');
                    
                    tourPaymentsInput.placeholder = "Contoh: Pembayaran via e-wallet, QRIS, dll";
                }
            }
            
            toggleTicketFields();
            hasTicketSelect.addEventListener('change', toggleTicketFields);
        });
    </script>
</body>
</html>