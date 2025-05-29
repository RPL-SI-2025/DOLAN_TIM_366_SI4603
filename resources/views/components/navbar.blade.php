<div class="w-full flex justify-center pt-6">
    <div class="bg-white glass rounded-full px-10 py-4 flex items-center justify-between shadow-lg max-w-3xl w-full">
      <div class="text-2xl font-bold text-purple-600">Dolan</div>
      <nav class="hidden md:flex gap-6 text-gray-800 font-medium">
        <a href="{{ route('home') }}" class="hover:text-purple-600">Home</a>
        <a href="{{ route('destination.index') }}" class="hover:text-purple-600">Tours</a>
        <a href="" class="hover:text-purple-600">Gallery</a>
        <a href="{{route('articles.index')}}" class="hover:text-purple-600">Article</a>
        <a href="#contribute" class="hover:text-purple-600">Contribute</a>
      </nav>
      @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin()))
      <a href={{route('dashboard.index')}} class="ml-4 bg-purple-600 text-white px-5 py-2 rounded-full hover:bg-purple-700 transition">
      Dashboard
      </a>
      @elseif (Auth::check() && (Auth::user()->isUser()))
      <a href={{route('user.profile.show')}} class="ml-4 bg-purple-600 text-white px-5 py-2 rounded-full hover:bg-purple-700 transition">
      Profile

      </a>
      @else
      <a href={{route('registration')}} class="ml-4 bg-purple-600 text-white px-5 py-2 rounded-full hover:bg-purple-700 transition">
      Register
      </a>
     @endif
    </div>
  </div>