<nav class="bg-indigo-800" x-data="{ navOpened: false, userDropdownOpened: false }">
  <div class="max-w-7xl mx-auto px-2 sm:px-6">
    <div class="relative flex items-center justify-between h-16">
      <div class="absolute inset-y-0 left-0 flex items-center lg:hidden">
        <button @click="navOpened = !navOpened" type="button" id="mobile-menu-button"
          class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
          aria-controls="mobile-menu" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <span><i class="fa-solid fa-bars fa-xl"></i></span>
        </button>
      </div>
      <div class="flex-1 flex items-center justify-center sm:items-stretch lg:justify-start">
        <a href="{{ route('home') }}" class="flex-shrink-0 flex items-center">
          <img class="block lg:hidden h-8 w-auto" src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg"
            alt="Workflow" />
          <img class="hidden lg:block h-8 w-auto"
            src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg" alt="Workflow" />
        </a>
        <div class="hidden lg:block sm:ml-6">
          <div class="flex space-x-4">
            <a href="{{ route('home') }}"
              class="text-white {{ request()->routeIs('home') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 px-3 py-2 rounded-md text-sm font-medium"
              aria-current="page">
              Home
            </a>
            <a href="{{ route('organizations') }}"
              class="text-white {{ request()->routeIs('organizations') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              Organizations
            </a>
            <a href="{{ route('speakers') }}"
              class="text-white {{ request()->routeIs('speakers') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              Speakers
            </a>
            <a href="{{ route('news') }}"
              class="text-white {{ request()->routeIs('news') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              News
            </a>
            <a href="{{ route('newsletter') }}"
              class="text-white {{ request()->routeIs('newsletter') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              Newsletter
            </a>
            <a href="#"
              class="text-white hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              About
            </a>
            <a href="{{ route('contact') }}"
              class="text-white {{ request()->routeIs('contact') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium">
              Contact
            </a>
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        @auth
          <div class="ml-3 relative">
            <div>
              <button @click="userDropdownOpened = !userDropdownOpened" type="button"
                class="bg-gray-800 flex text-sm rounded-full focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-gray-800 focus:ring-white"
                id="user-menu-button" aria-expanded="false" aria-haspopup="true">
                <span class="sr-only">Open user menu</span>
                <img class="h-8 w-8 rounded-full"
                  src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                  alt="">
              </button>
            </div>
            <div x-show="userDropdownOpened" x-cloak x-transition
              class="origin-top-right absolute right-0 mt-2 w-48 rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
              id="user-menu" role="menu" aria-orientation="vertical" aria-labelledby="user-menu-button" tabindex="-1">
              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                id="user-menu-item-0">Your Profile</a>
              <a href="#" class="block px-4 py-2 text-sm text-gray-700" role="menuitem" tabindex="-1"
                id="user-menu-item-1">Settings</a>
              <a href="{{ route('logout') }}" class="block px-4 py-2 text-sm text-gray-700" role="menuitem"
                tabindex="-1" id="user-menu-item-2">Sign out</a>
            </div>
          </div>
        @endauth
        @guest
          <a href="{{ route('login') }}" class="text-white bg-indigo-800 rounded-md px-4 py-2">
            Sign in
          </a>
          <div class="ml-3 relative">
            <div>
              <a href="{{ route('register') }}" class="bg-white text-indigo-800 rounded-md px-4 py-2">
                Sign up
              </a>
            </div>
          </div>
        @endguest
      </div>
    </div>
  </div>
  <div x-cloak x-show="navOpened" x-transition class="lg:hidden" id="mobile-menu">
    <div class="px-2 pt-2 pb-3 space-y-1">
      <a href="{{ route('home') }}" class="text-white {{ (request()->routeIs('home')) ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 block px-3 py-2 rounded-md text-base font-medium"
        aria-current="page">
        Home
      </a>
      <a href="{{ route('organizations') }}"
        class="text-white {{ (request()->routeIs('organizations')) ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
        Organizations
      </a>
      <a href="{{ route('speakers') }}"
        class="text-white {{ (request()->routeIs('speakers')) ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
        Speakers
      </a>
      <a href="{{ route('news') }}"
        class="text-white {{ (request()->routeIs('news')) ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
        News
      </a>
      <a href="{{ route('newsletter') }}"
        class="text-white {{ (request()->routeIs('newsletter')) ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
        News
      </a>
      <a href="#"
        class="text-white hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
        About
      </a>
      <a href="{{ route('contact') }}"
        class="text-white {{ (request()->routeIs('contact')) ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium">
        Contact
      </a>
    </div>
  </div>
</nav>
