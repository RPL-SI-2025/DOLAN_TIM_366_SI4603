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
<div id="ratingModal" class="modal fixed inset-0 bg-black bg-opacity-50 overflow-y-auto h-full w-full z-50 flex items-center justify-center" style="display: none;">
  <div class="relative mx-auto p-0 border-0 w-full max-w-lg shadow-2xl rounded-2xl bg-white m-4">
    
    <!-- Header Section -->
    <div class="bg-gradient-to-r from-purple-600 to-indigo-600 p-6 rounded-t-2xl">
      <div class="flex justify-between items-center">
        <div class="flex items-center space-x-3">
          <div class="w-10 h-10 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
            <svg class="w-5 h-5 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"></path>
            </svg>
          </div>
          <div>
            <h3 class="text-xl font-bold text-white" id="modalTitle">Rate & Review</h3>
            <p class="text-purple-100 text-sm">Share your experience</p>
          </div>
        </div>
        <button onclick="closeRatingModal()" class="text-white hover:text-gray-200 transition-colors p-2 rounded-full hover:bg-white hover:bg-opacity-10">
          <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
          </svg>
        </button>
      </div>
    </div>

    <!-- Form Content -->
    <div class="p-6">
      <form id="ratingForm" class="space-y-6">
        
        <!-- Rating Selection with Visual Stars -->
        <div>
          <label class="block mb-3 text-sm font-semibold text-gray-800">Rating</label>
          <div class="flex items-center space-x-1 mb-3">
            <div id="starRating" class="flex space-x-1">
              @for($i = 1; $i <= 5; $i++)
                <button type="button" class="star-btn text-gray-300 hover:text-yellow-400 transition-colors focus:outline-none" data-rating="{{ $i }}">
                  <svg class="w-8 h-8" fill="currentColor" viewBox="0 0 20 20">
                    <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                  </svg>
                </button>
              @endfor
            </div>
            <span id="ratingText" class="ml-3 text-sm text-gray-600 font-medium"></span>
          </div>
          <select name="rating" id="rating" class="hidden" required>
            <option value="">Select Rating</option>
            @for($i = 1; $i <= 5; $i++)
            <option value="{{ $i }}">{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
            @endfor
          </select>
          <div id="ratingError" class="mt-2 text-sm text-red-600 hidden"></div>
        </div>

        <!-- Feedback Textarea -->
        <div>
          <label for="feedback" class="block mb-3 text-sm font-semibold text-gray-800">Your Feedback</label>
          <textarea name="feedback" id="feedback" rows="4" 
                    class="w-full p-4 border border-gray-300 text-gray-900 text-sm rounded-xl focus:ring-2 focus:ring-purple-500 focus:border-purple-500 bg-gray-50 resize-none transition-all placeholder-gray-400" 
                    placeholder="Tell us about your experience at this destination..." 
                    required></textarea>
          <div class="flex justify-between items-center mt-2">
            <div id="feedbackError" class="text-sm text-red-600 hidden"></div>
            <div class="text-xs text-gray-500">
              <span id="charCount">0</span>/1000 characters
            </div>
          </div>
        </div>

        <!-- Action Buttons -->
        <div class="flex justify-end space-x-3 pt-4 border-t border-gray-100">
          <button type="button" onclick="closeRatingModal()" 
                  class="px-6 py-3 bg-gray-100 text-gray-700 rounded-xl hover:bg-gray-200 transition-colors font-medium border border-gray-200">
            Cancel
          </button>
          <button type="submit" 
                  class="px-6 py-3 bg-gradient-to-r from-purple-600 to-indigo-600 text-white rounded-xl hover:from-purple-700 hover:to-indigo-700 transition-all font-medium shadow-lg transform hover:scale-105 disabled:opacity-50 disabled:cursor-not-allowed disabled:transform-none" 
                  id="submitBtn">
            <span class="flex items-center space-x-2">
              <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
              </svg>
              <span>Submit Review</span>
            </span>
          </button>
        </div>
      </form>
    </div>
  </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
  // Star rating functionality
  const starButtons = document.querySelectorAll('.star-btn');
  const ratingSelect = document.getElementById('rating');
  const ratingText = document.getElementById('ratingText');
  const feedbackTextarea = document.getElementById('feedback');
  const charCount = document.getElementById('charCount');
  
  const ratingLabels = {
    1: 'Poor',
    2: 'Fair', 
    3: 'Good',
    4: 'Very Good',
    5: 'Excellent'
  };

  starButtons.forEach(button => {
    button.addEventListener('click', function() {
      const rating = parseInt(this.dataset.rating);
      ratingSelect.value = rating;
      
      // Update star colors
      starButtons.forEach((btn, index) => {
        if (index < rating) {
          btn.classList.remove('text-gray-300');
          btn.classList.add('text-yellow-400');
        } else {
          btn.classList.remove('text-yellow-400');
          btn.classList.add('text-gray-300');
        }
      });
      
      // Update rating text
      ratingText.textContent = ratingLabels[rating];
    });
    
    // Hover effect
    button.addEventListener('mouseenter', function() {
      const rating = parseInt(this.dataset.rating);
      starButtons.forEach((btn, index) => {
        if (index < rating) {
          btn.classList.add('text-yellow-300');
        }
      });
    });
    
    button.addEventListener('mouseleave', function() {
      starButtons.forEach(btn => {
        btn.classList.remove('text-yellow-300');
      });
    });
  });

  // Character counter
  feedbackTextarea.addEventListener('input', function() {
    const count = this.value.length;
    charCount.textContent = count;
    
    if (count > 1000) {
      charCount.parentElement.classList.add('text-red-500');
      this.classList.add('border-red-500');
    } else {
      charCount.parentElement.classList.remove('text-red-500');
      this.classList.remove('border-red-500');
    }
  });
});
</script>
</body>

</html>