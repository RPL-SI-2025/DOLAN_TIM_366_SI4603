<x-layout-admin>
<x-slot name="title">Daftar Destinasi</x-slot>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Daftar Destinasi</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 p-6">
    <div class="container mx-auto p-6 bg-white shadow-lg rounded-xl max-w-4xl">
        <h2 class="text-20xl font-semibold text-indigo-600 mb-8 text-center">Create New Destination</h2>

        <form action="{{ route('dashboard.destination.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf

            <div class="flex flex-col">
                <label for="name" class="text-sm font-semibold text-gray-700">Destination Name</label>
                <input type="text" id="name" name="name" required class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
            </div>

            <div class="flex flex-col">
                <label for="description" class="text-sm font-semibold text-gray-700">Description</label>
                <textarea id="description" name="description" rows="4" required class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out"></textarea>
            </div>

            <div class="flex flex-col">
                <label for="location" class="text-sm font-semibold text-gray-700">Location</label>
                <input type="text" id="location" name="location" required class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
            </div>

            <div class="flex flex-col">
                <label for="image" class="text-sm font-semibold text-gray-700 mb-2">Image</label>
                <input type="file" id="image" name="image" accept="image/*" required
                    class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out"
                    onchange="previewImage(event)">
                <img id="image-preview" class="mt-4 rounded shadow max-w-xs hidden" style="max-height: 200px;" alt="Preview">
            </div>

            <div class="flex flex-col">
                <label for="additional_images" class="text-sm font-semibold text-gray-700">Additional Images</label>
                <input type="file" id="additional_images" name="additional_images[]" accept="image/*" multiple
                    class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out"
                    onchange="previewAdditionalImages(event)">
                <div id="additional-images-preview" class="mt-4 flex space-x-4"></div>
            </div>

            <div class="flex flex-col">
                <label for="stock" class="text-sm font-semibold text-gray-700">Stock</label>
                <input type="number" id="stock" name="stock" required class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
            </div>

            <div class="flex flex-col">
                <label for="price" class="text-sm font-semibold text-gray-700">Price</label>
                <input type="number" id="price" name="price" required class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
            </div>

            <button type="submit" class="block w-full max-w-6xl mx-auto mt-6 px-6 py-3 bg-green-500 text-white font-semibold border-2 border-green-400 rounded-lg cursor-pointer transition duration-300 ease-in-out hover:bg-green-700 hover:shadow-lg">
                Tambahkan Destinasi
            </button>
        </form>
    </div>
</body>
</html>

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
    </script>
</x-layout-admin>
