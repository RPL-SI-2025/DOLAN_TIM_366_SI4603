<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Profile</title>
  @vite(['resources/css/app.css', 'resources/js/app.js', 'resources/js/rating-modal.js'],)
</head>

<body>
  <!-- Rating Modal -->
<div id="ratingModal" class="modal fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center" style="display: none;">
  <div class="relative mx-auto p-6 border w-full max-w-md shadow-xl rounded-xl bg-white">
    <div class="space-y-4">
      <!-- Header with gradient -->
      <div class="flex justify-between items-center p-4 bg-gradient-to-r from-purple-800 to-purple-500 text-white rounded-t-lg -m-6 mb-4">
        <h3 class="text-xl font-bold" id="modalTitle">Rate & Review</h3>
        <button onclick="closeRatingModal()" class="text-white hover:text-gray-200 transition-colors">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>

      <form id="ratingForm" class="space-y-4">
        <!-- Rating Selection -->
        <div>
          <label for="rating" class="block mb-2 text-sm font-semibold text-gray-800">Rating</label>
          <select name="rating" id="rating" class="w-full p-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-gray-50 transition-all" required>
            <option value="">Select Rating</option>
            @for($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
            @endfor
          </select>
          <div id="ratingError" class="mt-2 text-sm text-red-600 hidden"></div>
        </div>

        <!-- Feedback Textarea -->
        <div>
          <label for="feedback" class="block mb-2 text-sm font-semibold text-gray-800">Feedback</label>
          <textarea name="feedback" id="feedback" rows="3" class="w-full p-3 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 bg-gray-50 resize-none transition-all" placeholder="Share your experience..." required></textarea>
          <div id="feedbackError" class="mt-2 text-sm text-red-600 hidden"></div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 pt-2">
          <button type="button" onclick="closeRatingModal()" class="px-5 py-2.5 bg-gray-300 text-gray-700 rounded-lg hover:bg-gray-400 transition-colors font-medium">
            Cancel
          </button>
          <button type="submit" class="px-5 py-2.5 bg-gradient-to-r from-purple-500 to-purple-800 text-white rounded-lg hover:from-purple-600 hover:to-purple-900 transition-all font-medium shadow-md" id="submitBtn">
            Submit
          </button>
        </div>
      </form>
    </div>
  </div>
</div>
</body>

</html>