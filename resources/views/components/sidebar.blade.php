<aside id="logo-sidebar"
  class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
  aria-label="Sidebar">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
    <ul class="space-y-2 font-medium">
      <li>
        <a href="{{ route('dashboard.index') }}"
        class="flex items-center p-2 {{ Request::is('dashboard') ? 'active text-white bg-green-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
        <svg
            class="w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
            <path d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
            <path
              d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
          </svg>
          <span class="ms-3">Dashboard</span>
        </a>
      </li>
      <li>
        <a href="{{ route('dashboard.destination.index') }}"
         class="flex items-center p-2 {{ Request::is('dashboard/destination') ? 'active text-white bg-green-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
          <svg
            class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
            <path
              d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
          </svg>
          <span class="flex-1 ms-3 whitespace-nowrap">Itineraries</span>
        </a>
      </li>
      <li>
          <li>
    <a href="{{ route('dashboard.destination.pending') }}"
         class="flex items-center p-2 {{ Request::is('dashboard/destinations/pending') ? 'active text-white bg-green-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
          <svg
            class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
            <path
              d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
          </svg>
          <span class="flex-1 ms-3 whitespace-nowrap">Destination Request</span>
        </a>
      </li>
      <li>
      <a href="{{ route('dashboard.articles.index') }}"
      class="flex items-center p-2 {{ Request::is('dashboard/articles') ? 'active text-white bg-green-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
      <svg
            class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Article</span>
          </a>
          </li>
                      @if (Auth::check() && (Auth::user()->isSuperAdmin()))
          <li>
          <a href="/dashboard/admin"
         class="flex items-center p-2 {{ Request::is('dashboard/admin') ? 'active text-white bg-green-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
            <svg
            class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
            <path
              d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Admin</span>
          </a>
          </li>
          @endif
          <li>
          <a href="{{ route('dashboard.merchandise.index') }}"
            class="flex items-center p-2 {{ Request::is('dashboard/merchandise') ? 'active text-white bg-green-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
            <svg
            class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
            <path d="M16 6a2 2 0 0 0-2-2h-1V3a3 3 0 1 0-6 0v1H6a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h8a2 2 0 0 0 2-2V6Zm-8-3a1 1 0 1 1 2 0v1H8V3Zm6 13H6V6h8v10Z"/>
            </svg>
     
            <span class="flex-1 ms-3 whitespace-nowrap">Merchandise</span>
          </a>
          </li>
    </ul>
  </div>
</aside>
