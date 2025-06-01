<x-layout-admin>
    <x-slot name="title">Edit Destinasi</x-slot>
    
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-xl max-w-4xl">
        <h2 class="text-2xl font-semibold text-indigo-600 mb-8 text-center">Edit Destinasi Wisata</h2>

        <form action="{{ route('dashboard.destination.update', $destination->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6" id="destination-form">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Left Column -->
                <div class="space-y-6">
                    <div class="flex flex-col">
                        <label for="name" class="text-sm font-semibold text-gray-700 mb-1">Nama Destinasi</label>
                        <input type="text" id="name" name="name" required value="{{ old('name', $destination->name) }}"
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>

                    <div class="flex flex-col">
                        <label for="location" class="text-sm font-semibold text-gray-700 mb-1">Lokasi</label>
                        <input type="text" id="location" name="location" required value="{{ old('location', $destination->location) }}"
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                    </div>

                    <div class="flex flex-col">
                        <label for="description" class="text-sm font-semibold text-gray-700 mb-1">Deskripsi</label>
                        <textarea id="description" name="description" rows="4" required
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">{{ old('description', $destination->description) }}</textarea>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="tour_includes" class="text-sm font-semibold text-gray-700 mb-1">Fasilitas & Fitur Tour</label>
                        <textarea id="tour_includes" name="tour_includes" rows="4" 
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                            placeholder="Contoh: Air terjun indah dan memukau, ada kolam renang untuk anak, dll">{{ old('tour_includes', $destination->tour_includes) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Deskripsi lengkap tentang apa saja yang disediakan di lokasi wisata</p>
                    </div>
                </div>

                <!-- Right Column -->
                <div class="space-y-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="flex flex-col">
                            <label for="stock" class="text-sm font-semibold text-gray-700 mb-1">Stok</label>
                            <input type="number" id="stock" name="stock" required value="{{ old('stock', $destination->stock) }}"
                                class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        </div>

                        <div class="flex flex-col">
                            <label for="price" class="text-sm font-semibold text-gray-700 mb-1">Harga</label>
                            <input type="number" id="price" name="price" required value="{{ old('price', $destination->price) }}"
                                class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                        </div>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="tour_payments" class="text-sm font-semibold text-gray-700 mb-1">Informasi Pembayaran</label>
                        <textarea id="tour_payments" name="tour_payments" rows="4" 
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                            placeholder="Contoh: HTM 10.000-15.000 rupiah untuk dewasa, pembayaran bisa dilakukan dengan e-wallet, QRIS, dll">{{ old('tour_payments', $destination->tour_payments) }}</textarea>
                        <p class="text-xs text-gray-500 mt-1">Informasi tentang metode pembayaran yang tersedia</p>
                    </div>
                    
                    <div class="flex flex-col">
                        <label for="has_ticket" class="text-sm font-semibold text-gray-700 mb-1">Memiliki Tiket</label>
                        <select id="has_ticket" name="has_ticket" 
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition">
                            <option value="1" {{ old('has_ticket', $destination->has_ticket) == 1 ? 'selected' : '' }}>Ya</option>
                            <option value="0" {{ old('has_ticket', $destination->has_ticket) == 0 ? 'selected' : '' }}>Tidak</option>
                        </select>
                        <p class="text-xs text-gray-500 mt-1">Jika tidak, pengunjung tidak perlu melakukan pembayaran dan booking</p>
                    </div>

                    <div class="flex flex-col">
                        <label for="image" class="text-sm font-semibold text-gray-700 mb-1">Gambar Utama</label>
                        <input type="file" id="image" name="image" accept="image/*"
                            class="p-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                            onchange="previewMainImage(event)">
                        @if ($destination->image)
                            <div class="mt-3 relative" id="main-image-container">
                                <img src="{{ asset($destination->image) }}" alt="Destinasi Image" id="main-image-preview"
                                    class="rounded shadow max-h-40">
                            </div>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Additional Images Section -->
            <div class="pt-4">
                <h3 class="text-lg font-medium text-gray-800 mb-2">Gambar Tambahan</h3>
                
                @if ($destination->additional_images && is_array($destination->additional_images) && count($destination->additional_images) > 0)
                    <div class="bg-gray-50 p-4 rounded-lg border border-gray-200">
                        <p class="text-sm text-gray-600 mb-3">Gambar saat ini:</p>
                        <div class="flex flex-wrap gap-4" id="additional-images-container">
                            @foreach ($destination->additional_images as $index => $image)
                                <div class="relative w-32 bg-white p-2 rounded shadow-sm" id="image-container-{{ $index }}">
                                    <img src="{{ asset($image) }}" alt="Additional Image {{ $index + 1 }}"
                                        class="w-full h-24 object-cover rounded mb-2">
                                    
                                    <div class="flex justify-end">
                                        <button type="button" onclick="removeImage('{{ $image }}', {{ $index }})" 
                                            class="bg-red-500 text-white rounded p-1 text-xs hover:bg-red-600 transition">
                                            Hapus
                                        </button>
                                    </div>
                                    
                                    <input type="hidden" name="existing_images[]" value="{{ $image }}" id="existing-image-{{ $index }}">
                                </div>
                            @endforeach
                        </div>
                    </div>
                @else
                    <p class="text-gray-500 italic text-sm">Belum ada gambar tambahan</p>
                @endif

                <div class="mt-4">
                    <label for="additional_images" class="text-sm font-semibold text-gray-700 mb-1">Tambah Gambar Baru</label>
                    <input type="file" id="additional_images" name="additional_images[]" multiple accept="image/*"
                        class="p-3 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition"
                        onchange="previewNewImages(event)">
                    <div id="new-images-preview" class="flex flex-wrap gap-2 mt-2"></div>
                </div>
            </div>

            <div id="removed-images-container">
                <!-- Hidden inputs for removed images will be added here -->
            </div>

            <div class="pt-4">
                <button type="submit" class="w-full py-3 bg-green-500 text-white font-semibold rounded-lg transition hover:bg-green-600 focus:ring-2 focus:ring-green-300">
                    Perbarui Destinasi
                </button>
            </div>
        </form>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
        const hasTicketSelect = document.getElementById('has_ticket');
        const priceInput = document.getElementById('price');
        const stockInput = document.getElementById('stock');
        const tourPaymentsInput = document.getElementById('tour_payments');
        
        function toggleTicketFields() {
            const hasTicket = hasTicketSelect.value === '1';
            
            // Instead of hiding, disable the fields
            priceInput.disabled = !hasTicket;
            stockInput.disabled = !hasTicket;
            tourPaymentsInput.disabled = !hasTicket;
            
            // Add visual cue to disabled fields
            if (!hasTicket) {
                priceInput.classList.add('bg-gray-100');
                stockInput.classList.add('bg-gray-100');
                tourPaymentsInput.classList.add('bg-gray-100');
                
                // Set default values for disabled fields
                priceInput.value = "0";
                stockInput.value = "0";
                tourPaymentsInput.value = "";
                
                // Add a placeholder text
                tourPaymentsInput.placeholder = "Tidak tersedia untuk destinasi tanpa tiket";
            } else {
                priceInput.classList.remove('bg-gray-100');
                stockInput.classList.remove('bg-gray-100');
                tourPaymentsInput.classList.remove('bg-gray-100');
                
                // Reset placeholder if coming from disabled state
                if (tourPaymentsInput.placeholder === "Tidak tersedia untuk destinasi tanpa tiket") {
                    tourPaymentsInput.placeholder = "Contoh: HTM 10.000-15.000 rupiah untuk dewasa, pembayaran bisa dilakukan dengan e-wallet, QRIS, dll";
                }
            }
            
            // Toggle required attribute
            priceInput.required = hasTicket;
            stockInput.required = hasTicket;
        }
        
        // Initial toggle based on current value
        toggleTicketFields();
        
        // Add event listener for changes
        hasTicketSelect.addEventListener('change', toggleTicketFields);
    });
    
    // Array to store removed images
    const removedImages = [];
    
    function removeImage(imagePath, index) {
        // Show loading or disable button
        const container = document.getElementById('image-container-' + index);
        container.classList.add('opacity-50');
        
        // AJAX call to delete the image physically from storage
        fetch('{{ route("dashboard.destination.removeImage") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                image_path: imagePath
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Add to removed images array for form submission
                removedImages.push(imagePath);
                
                // Remove the container from UI with animation
                setTimeout(() => {
                    container.remove();
                }, 300);
                
                // Update hidden input field for form submission
                updateRemovedImagesField();
                
                // Show success message
                showNotification('Gambar berhasil dihapus', 'success');
            } else {
                // Show error and revert opacity
                container.classList.remove('opacity-50');
                showNotification('Gagal menghapus gambar: ' + data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            container.classList.remove('opacity-50');
            showNotification('Terjadi kesalahan saat menghapus gambar', 'error');
        });
    }
    
    function updateRemovedImagesField() {
        // Get the container for removed images
        const container = document.getElementById('removed-images-container');
        container.innerHTML = ''; // Clear existing inputs
        
        // Add new hidden inputs for each removed image
        removedImages.forEach(image => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'removed_images[]';
            input.value = image;
            container.appendChild(input);
        });
    }
    
    function previewMainImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const previewImg = document.getElementById('main-image-preview');
            if (previewImg) {
                previewImg.src = reader.result;
            } else {
                const newImg = document.createElement('img');
                newImg.src = reader.result;
                newImg.id = 'main-image-preview';
                newImg.classList.add('rounded', 'shadow', 'max-h-40', 'mt-3');
                
                const container = document.querySelector('label[for="image"]').parentNode;
                container.appendChild(newImg);
            }
        }
        if (event.target.files[0]) {
            reader.readAsDataURL(event.target.files[0]);
        }
    }
    
    function previewNewImages(event) {
        const previewContainer = document.getElementById('new-images-preview');
        previewContainer.innerHTML = '';
        
        Array.from(event.target.files).forEach((file, idx) => {
            const reader = new FileReader();
            reader.onload = function() {
                const imgContainer = document.createElement('div');
                imgContainer.classList.add('relative', 'w-24', 'h-24');
                
                const imgElement = document.createElement('img');
                imgElement.src = reader.result;
                imgElement.classList.add('w-full', 'h-full', 'object-cover', 'rounded', 'shadow-sm');
                
                imgContainer.appendChild(imgElement);
                previewContainer.appendChild(imgContainer);
            }
            reader.readAsDataURL(file);
        });
    }
    
    function showNotification(message, type = 'info') {
        // Create notification element
        const notification = document.createElement('div');
        notification.className = `fixed bottom-4 right-4 p-4 rounded shadow-lg ${
            type === 'success' ? 'bg-green-500' : 
            type === 'error' ? 'bg-red-500' : 
            'bg-blue-500'
        } text-white`;
        notification.innerText = message;
        
        // Add to DOM
        document.body.appendChild(notification);
        
        // Remove after 3 seconds
        setTimeout(() => {
            notification.classList.add('opacity-0', 'transition-opacity');
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, 3000);
    }
    </script>
</x-layout-admin>