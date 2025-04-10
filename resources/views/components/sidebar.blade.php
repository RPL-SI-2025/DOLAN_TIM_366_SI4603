<aside id="logo-sidebar"
  class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0"
  aria-label="Sidebar">
  <div class="h-full px-3 pb-4 overflow-y-auto bg-white">
    <ul class="space-y-2 font-medium">
      <li>
        <a href="{{ route('dashboard.index') }}"
        class="flex items-center p-2 {{ Request::is('dashboard') ? 'active text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
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
        <a href="{{ route('dashboard.itineraries.index') }}"
         class="flex items-center p-2 {{ Request::is('dashboard/itineraries') ? 'active text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
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
        <a href="{{ route('dashboard.destinations.index') }}"
          class="flex items-center p-2 {{ Request::is('dashboard/destinations') ? 'active text-white bg-blue-600' : 'text-gray-900 hover:bg-gray-100' }} rounded-lg group">
          <svg
            class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path d="M10 0C4.486 0 0 4.486 0 10s10 10 10 10 10-4.486 10-10S15.514 0 10 0zm0 15a5 5 0 1 1 0-10 5 5 0 0 1 0 10z"/>
          </svg>
          <span class="flex-1 ms-3 whitespace-nowrap">Destinations</span>
        </a>
      </li>
      <li>
        <a href="#"
          class="flex items-center p-2 text-gray-900 hover:bg-gray-100 rounded-lg group">
          <svg
            class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
            <path
              d="m17.418 3.623-.018-.008a6.713 6.713 0 0 0-2.4-.569V2h1a1 1 0 1 0 0-2h-2a1 1 0 0 0-1 1v2H9.89A6.977 6.977 0 0 1 12 8v5h-2V8A5 5 0 1 0 0 8v6a1 1 0 0 0 1 1h8v4a1 1 0 0 0 1 1h2a1 1 0 0 0 1-1v-4h6a1 1 0 0 0 1-1V8a5 5 0 0 0-2.582-4.377ZM6 12H4a1 1 0 0 1 0-2h2a1 1 0 0 1 0 2Z" />
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Article <em>(coming soon)</em></span>
          </a>
          </li>
          <li>
          <a href="#"
            class="flex items-center p-2 text-gray-900 hover:bg-gray-100 rounded-lg group">
            <svg
            class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 18">
            <path
              d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Admin <em>(coming soon)</em></span>
          </a>
          </li>
          <li>
          <a href="#"
            class="flex items-center p-2 text-gray-900 hover:bg-gray-100 rounded-lg group">
            <svg
            class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
            <path
              d="M17 5.923A1 1 0 0 0 16 5h-3V4a4 4 0 1 0-8 0v1H2a1 1 0 0 0-1 .923L.086 17.846A2 2 0 0 0 2.08 20h13.84a2 2 0 0 0 1.994-2.153L17 5.923ZM7 9a1 1 0 0 1-2 0V7h2v2Zm0-5a2 2 0 1 1 4 0v1H7V4Zm6 5a1 1 0 1 1-2 0V7h2v2Z" />
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Merchandise <em>(coming soon)</em></span>
          </a>
          </li>
          <li>
          <a href="#"
            class="flex items-center p-2 text-gray-900 hover:bg-gray-100 rounded-lg group">
            <svg
            class="flex-shrink-0 w-5 h-5 text-gray-500 group-hover:text-gray-900 transition duration-75"
            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor"
            viewBox="0 0 24 24">
            <path fill-rule="evenodd" d="M13 10a1 1 0 0 1 1-1h.01a1 1 0 1 1 0 2H14a1 1 0 0 1-1-1Z"
              clip-rule="evenodd" />
            <path fill-rule="evenodd"
              d="M2 6a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v12c0 .556-.227 1.06-.593 1.422A.999.999 0 0 1 20.5 20H4a2.002 2.002 0 0 1-2-2V6Zm6.892 12 3.833-5.356-3.99-4.322a1 1 0 0 0-1.549.097L4 12.879V6h16v9.95l-3.257-3.619a1 1 0 0 0-1.557.088L11.2 18H8.892Z"
              clip-rule="evenodd" />
            </svg>
            <span class="flex-1 ms-3 whitespace-nowrap">Gallery <em>(coming soon)</em></span>
        </a>
      </li>
    </ul>
  </div>
</aside>
