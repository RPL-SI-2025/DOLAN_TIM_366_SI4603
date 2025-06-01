<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/rating-modal.js'],)
</head>

<body>
  <!-- All Ratings Modal -->
<div id="allRatingsModal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center" style="display: none;">
  <div class="relative mx-auto p-6 border w-11/12 max-w-2xl shadow-xl rounded-xl bg-white">
    <div class="space-y-4">
      <!-- Header with gradient -->
      <div class="flex justify-between items-center p-4 bg-gradient-to-r from-purple-800 to-purple-500 text-white rounded-t-lg -m-6 mb-4">
        <h3 class="text-xl font-bold">All Reviews</h3>
        <button onclick="closeAllRatingsModal()" class="text-white hover:text-gray-200 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <!-- Content Container -->
      <div id="allRatingsContainer" class="max-h-80 overflow-y-auto pr-2 space-y-4">
        <!-- Loading Spinner -->
        <div id="loadingSpinner" class="text-center py-8">
          <div class="inline-block animate-spin rounded-full h-8 w-8 border-b-2 border-purple-600"></div>
          <p class="mt-2 text-gray-600 font-medium">Loading reviews...</p>
        </div>
      </div>
    </div>
  </div>
</div>
</body>

</html>