<x-layout-admin>
    <style>
        .submit-button {
            display: block; width: 100%; max-width: 1500px; margin: 24px auto 0; padding: 12px 24px;
            background-color:rgb(61, 216, 118); color: white; font-weight: 600; border: 2px solidrgb(38, 255, 118);
            border-radius: 8px; cursor: pointer; transition: background-color 0.3s ease, box-shadow 0.3s ease;
        }
        .submit-button:hover { background-color: #15803d; box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2); }
    </style>

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
                <label for="stock" class="text-sm font-semibold text-gray-700">Stock</label>
                <input type="number" id="stock" name="stock" required class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
            </div>

            <div class="flex flex-col">
                <label for="price" class="text-sm font-semibold text-gray-700">Price</label>
                <input type="number" id="price" name="price" required class="mt-2 p-4 border border-gray-300 rounded-lg w-full focus:outline-none focus:ring-2 focus:ring-indigo-500 transition duration-300 ease-in-out">
            </div>

            <button type="submit" class="submit-button">Tambahkan Destinasi</button>
        </form>
    </div>
</x-layout-admin>
