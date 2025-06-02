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
<div id="allRatingsModal" class="modal fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center" style="display: none;">
  <div class="relative mx-auto p-0 border-0 w-11/12 max-w-4xl shadow-2xl rounded-2xl bg-white m-4 max-h-[90vh] flex flex-col">
    
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6 rounded-t-2xl flex-shrink-0">
      <div class="flex justify-between items-center">
        <div class="flex items-center space-x-3">
          <div class="w-12 h-12 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
            </svg>
          </div>
          <div>
            <h3 class="text-2xl font-bold text-white">All Reviews</h3>
            <p class="text-purple-100 text-sm">See what travelers are saying</p>
          </div>
        </div>
        <button onclick="closeAllRatingsModal()" class="text-white hover:text-gray-200 transition-colors p-2 rounded-full hover:bg-white hover:bg-opacity-10">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Stats Bar -->
    <div class="bg-gray-50 px-6 py-4 border-b border-gray-200 flex-shrink-0">
      <div class="flex items-center justify-between">
        <div class="flex items-center space-x-6">
          <div class="flex items-center space-x-2">
            <div class="flex text-yellow-400">
              @php
                $averageRating = $destinations->ratings->avg('rating') ?? 0;
                $totalReviews = $destinations->ratings->count();
                $fullStars = floor($averageRating);
                $hasHalfStar = ($averageRating - $fullStars) >= 0.5;
              @endphp
              
              @for($i = 1; $i <= 5; $i++)
                <svg class="w-5 h-5 {{ $i <= $fullStars ? 'text-yellow-400' : 'text-gray-300' }}" fill="currentColor" viewBox="0 0 20 20">
                  <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                </svg>
              @endfor
            </div>
            <span class="text-lg font-semibold text-gray-900" id="averageRating">{{ number_format($averageRating, 1) }}</span>
            <span class="text-gray-500">•</span>
            <span class="text-gray-600" id="totalReviews">{{ $totalReviews }} {{ $totalReviews == 1 ? 'review' : 'reviews' }}</span>
          </div>
        </div>
        <div class="flex items-center space-x-3">

        </div>
      </div>
    </div>

    <!-- Content Container -->
    <div id="allRatingsContainer" class="flex-1 overflow-y-auto p-6">
      
      <!-- Loading Spinner -->
      <div id="loadingSpinner" class="text-center py-12">
        <div class="inline-block animate-spin rounded-full h-12 w-12 border-4 border-purple-200 border-t-purple-600"></div>
        <p class="mt-4 text-gray-600 font-medium">Loading reviews...</p>
      </div>

      <!-- Reviews Container -->
      <div id="reviewsList" class="space-y-6 hidden">
        <!-- Reviews will be loaded here -->
      </div>

      <!-- Empty State -->
      <div id="emptyState" class="text-center py-12 hidden">
        <div class="w-20 h-20 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
          <svg class="w-10 h-10 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z"></path>
          </svg>
        </div>
        <h3 class="text-lg font-semibold text-gray-900 mb-2">No Reviews Yet</h3>
        <p class="text-gray-600">Be the first to share your experience!</p>
      </div>
    </div>

    <!-- Footer -->
    <div class="bg-gray-50 px-6 py-4 rounded-b-2xl border-t border-gray-200 flex-shrink-0">
      <div class="flex justify-between items-center">
        <p class="text-sm text-gray-600">Showing all customer reviews</p>
        <button onclick="closeAllRatingsModal()" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-medium">
          Close
        </button>
      </div>
    </div>
  </div>
</div>

<style>
/* Custom scrollbar for reviews container */
#allRatingsContainer::-webkit-scrollbar {
  width: 6px;
}

#allRatingsContainer::-webkit-scrollbar-track {
  background: #f1f1f1;
  border-radius: 3px;
}

#allRatingsContainer::-webkit-scrollbar-thumb {
  background: #c1c1c1;
  border-radius: 3px;
}

#allRatingsContainer::-webkit-scrollbar-thumb:hover {
  background: #a1a1a1;
}

/* Review item styling */
.review-item {
  transition: all 0.2s ease;
}

.review-item:hover {
  transform: translateY(-1px);
  box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
}
</style>
</body>

</html>