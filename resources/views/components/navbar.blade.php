<div class="w-full flex justify-center pt-6">
    <div class="bg-white glass rounded-full px-10 py-4 flex items-center justify-between shadow-lg max-w-4xl w-full">
      <div class="text-2xl font-bold text-purple-600 mr-2">Dolan</div>
      <nav class="hidden md:flex gap-6 text-gray-800 font-medium">
        <a href="{{ route('home') }}" class="hover:text-purple-600">Home</a>
        <a href="{{ route('destination.index') }}" class="hover:text-purple-600">Tours</a>
        <a href="{{ route('wishlist.show') }}" class="hover:text-purple-600">Wishlist</a>
        <a href="{{ route('merchandise.index') }}" class="hover:text-purple-600">Merchandise</a>
        <a href="{{route('articles.index')}}" class="hover:text-purple-600">Article</a>
        <a href="{{route('user.destinations.index')}}" class="hover:text-purple-600">Contribute</a>
      </nav>
      <div class="flex items-center gap-3 ml-2">
        @if (Auth::check() && (Auth::user()->isAdmin() || Auth::user()->isSuperAdmin()))
        <a href="{{ route('dashboard.index') }}" class="bg-purple-600 text-white px-5 py-2 rounded-full hover:bg-purple-700 transition ml-2">
          Dashboard
        </a>
        @elseif (Auth::check() && (Auth::user()->isUser()))
        <a href="{{ route('user.profile.show') }}" class="bg-purple-600 text-white px-5 py-2 rounded-full hover:bg-purple-700 transition">Profile</a>
        <a href="{{ route('user.orders') }}" class="text-gray-700 hover:text-purple-600">My Orders</a>
        @else
        <a href="{{ route('registration') }}" class="bg-purple-600 text-white px-5 py-2 rounded-full hover:bg-purple-700 transition">
          Register
        </a>
        @endif
      </div>
    </div>
  </div>
