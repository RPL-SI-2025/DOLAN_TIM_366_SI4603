<x-layout-admin>
    <x-slot name="title">Tambah Destinasi</x-slot>
    
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-xl max-w-4xl">
        <h2 class="text-2xl font-semibold text-indigo-600 mb-8 text-center">Tambah Destinasi Baru</h2>

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

        <form action="{{ route('dashboard.destination.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

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
                        <p class="text-xs text-gray-500 mt-1">Deskripsi lengkap tentang apa saja yang disediakan di lokasi wisata</p>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="flex flex-col">
                        <label for="has_ticket" class="text-sm font-semibold text-gray-700 mb-1">Memiliki Tiket</label>
                        <select id="has_ticket" name="has_ticket" 
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            <option value="1" {{ old('has_ticket', '1') == '1' ? 'selected' : '' }}>Ya</option>
                            <option value="0" {{ old('has_ticket') == '0' ? 'selected' : '' }}>Tidak</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Jika ya, tiket akan dibuat terpisah di menu tiket</p>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="tour_payments" class="text-sm font-semibold text-gray-700 mb-1">Informasi Pembayaran</label>
                        <textarea id="tour_payments" name="tour_payments" rows="4" 
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                            placeholder="Contoh: HTM 10.000-15.000 rupiah untuk dewasa, pembayaran bisa dilakukan dengan e-wallet, QRIS, dll">{{ old('tour_payments') }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Informasi tentang metode pembayaran yang tersedia</p>
                    </div>

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
            const tourPaymentsInput = document.getElementById('tour_payments');
            
            function toggleTicketFields() {
                const hasTicket = hasTicketSelect.value === '1';
                
                tourPaymentsInput.disabled = !hasTicket;
                
                if (!hasTicket) {
                    tourPaymentsInput.classList.add('bg-gray-100');
                    tourPaymentsInput.value = "";
                    tourPaymentsInput.placeholder = "Tidak tersedia untuk destinasi tanpa tiket";
                } else {
                    tourPaymentsInput.classList.remove('bg-gray-100');
                    tourPaymentsInput.placeholder = "Contoh: HTM 10.000-15.000 rupiah untuk dewasa, pembayaran bisa dilakukan dengan e-wallet, QRIS, dll";
                }
            }
            
            toggleTicketFields();
            hasTicketSelect.addEventListener('change', toggleTicketFields);
        });
    </script>
</x-layout-admin>