<x-layout-admin>
  <h1 class="text-2xl font-bold text-gray-800 mb-6">Welcome User to Dashboard</h1>

  <div class="grid grid-cols-1 gap-4 md:grid-cols-2 lg:grid-cols-3">
    <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
      <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Statistics</h2>
      <p class="text-gray-600 dark:text-gray-400">Here you can find some statistics about the website.</p>
      </ul>
    </div>
    <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
      <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Recent Articles</h2>
      <p class="text-gray-600 dark:text-gray-400">Here you can find the most recent articles.</p>
    </div>
    <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
      <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Recent Users</h2>
      <p class="text-gray-600 dark:text-gray-400">Here you can find the most recent users.</p>
      <ul class="mt-4 space-y-2">
      </ul>
    </div>
    <div class="p-4 bg-white rounded-lg shadow-md dark:bg-gray-800">
      <h2 class="text-lg font-semibold text-gray-700 dark:text-gray-200">Ratings & Reviews</h2>
      <p class="text-gray-600 dark:text-gray-400">Manage user ratings and reviews for destinations.</p>
      <div class="mt-4">
        <a href="{{ route('dashboard.ratings.index') }}" class="inline-flex items-center px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition">
          View All Ratings
          <svg class="w-5 h-5 ml-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
          </svg>
        </a>
      </div>
    </div>
  </div>
</x-layout-admin>
