<!doctype html>
<html>

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Rate & Review: {{ $destination->name }} | Dolan</title>
  <style>
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: opacity 0.6s ease-out, transform 0.6s ease-out;
    }
    .animate-on-scroll.visible {
        opacity: 1;
        transform: translateY(0);
    }
  </style>
  @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="bg-gradient-to-b from-[#F0ECEC] to-white">
  <main>
    <div>
      <section class="bg-white dark:bg-gray-900 bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern.svg')] dark:bg-[url('https://flowbite.s3.amazonaws.com/docs/jumbotron/hero-pattern-dark.svg')]">
        <div class="py-8 px-4 mx-auto max-w-screen-xl text-center lg:py-16 z-10 relative">
          <h1 class="mb-4 text-4xl font-extrabold tracking-tight leading-none text-gray-900 md:text-5xl lg:text-6xl dark:text-white">Rate & Review</h1>
          <p class="mb-8 text-lg font-normal text-gray-500 lg:text-xl sm:px-16 lg:px-48 dark:text-gray-200">Share your experience at {{ $destination->name }}</p>
        </div>
        <div class="bg-gradient-to-b from-purple-50 to-transparent dark:from-purple-900 w-full h-full absolute top-0 left-0 z-0"></div>
      </section>
    </div>

    <div class="mx-auto max-w-7xl px-4 py-6 sm:px-6 lg:px-8">
      <div class="max-w-2xl mx-auto">
        <div class="bg-white drop-shadow-lg border border-gray-200 rounded-lg shadow-sm dark:bg-gray-800 dark:border-gray-700 p-6">
          <form action="{{ route('user.ratings.store', $destination) }}" method="POST">
            @csrf
            <div class="mb-6">
              <label for="rating" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Rating</label>
              <select name="rating" id="rating" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500 @error('rating') border-red-500 @enderror" required>
                <option value="">Select Rating</option>
                @for($i = 1; $i <= 5; $i++)
                  <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>{{ $i }} Star{{ $i > 1 ? 's' : '' }}</option>
                @endfor
              </select>
              @error('rating')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="mb-6">
              <label for="feedback" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Feedback</label>
              <textarea name="feedback" id="feedback" rows="5" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-purple-500 focus:border-purple-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-purple-500 dark:focus:border-purple-500 @error('feedback') border-red-500 @enderror" required>{{ old('feedback') }}</textarea>
              @error('feedback')
                <p class="mt-2 text-sm text-red-600 dark:text-red-500">{{ $message }}</p>
              @enderror
            </div>

            <div class="flex items-center space-x-4">
              <button type="submit" class="text-white bg-gradient-to-br from-purple-400 to-black hover:bg-gradient-to-bl focus:ring-4 focus:outline-none focus:ring-gray-200 dark:focus:ring-purple-800 font-medium rounded-lg text-sm px-5 py-2.5 text-center">Submit Rating</button>
              <a href="{{ route('destinations.show', $destination) }}" class="text-gray-900 bg-white border border-gray-300 focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-gray-800 dark:text-white dark:border-gray-600 dark:hover:bg-gray-700 dark:hover:border-gray-600 dark:focus:ring-gray-700">Cancel</a>
            </div>
          </form>
        </div>
      </div>
    </div>
  </main>
</body>
</html>