<nav class="bg-indigo-800">
  <div class="max-w-7xl mx-auto px-2 sm:px-6">
    <div class="relative flex items-center justify-between h-16">
      <div class="absolute inset-y-0 left-0 flex items-center lg:hidden">
        <button
          type="button"
          id="mobile-menu-button"
          class="inline-flex items-center justify-center p-2 rounded-md text-white hover:text-white hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"
          aria-controls="mobile-menu"
          aria-expanded="false"
        >
          <span class="sr-only">Open main menu</span>

          <svg
            class="block h-6 w-6"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M4 6h16M4 12h16M4 18h16"
            />
          </svg>

          <svg
            class="hidden h-6 w-6"
            xmlns="http://www.w3.org/2000/svg"
            fill="none"
            viewBox="0 0 24 24"
            stroke="currentColor"
            aria-hidden="true"
          >
            <path
              stroke-linecap="round"
              stroke-linejoin="round"
              stroke-width="2"
              d="M6 18L18 6M6 6l12 12"
            />
          </svg>
        </button>
      </div>
      <div class="flex-1 flex items-center justify-center sm:items-stretch lg:justify-start">
        <a href="/" class="flex-shrink-0 flex items-center">
          <img
            class="block lg:hidden h-8 w-auto"
            src="https://tailwindui.com/img/logos/workflow-mark-indigo-500.svg"
            alt="Workflow"
          />
          <img
            class="hidden lg:block h-8 w-auto"
            src="https://tailwindui.com/img/logos/workflow-logo-indigo-500-mark-white-text.svg"
            alt="Workflow"
          />
        </a>
        <div class="hidden lg:block sm:ml-6">
          <div class="flex space-x-4">
            <a
              href="/"
              class="bg-indigo-600 text-white px-3 py-2 rounded-md text-sm font-medium"
              aria-current="page"
            >
              Home
            </a>

            <a
              href="/organizations"
              class="text-white hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
            >
              Organizations
            </a>

            <a
              href="/speakers"
              class="text-white hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
            >
              Speakers
            </a>

            <a
              href="/news"
              class="text-white hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
            >
              News
            </a>

            <a
              href="/about"
              class="text-white hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
            >
              About
            </a>

            <a
              href="/contact"
              class="text-white hover:bg-indigo-600 hover:text-white px-3 py-2 rounded-md text-sm font-medium"
            >
              Contact
            </a>
          </div>
        </div>
      </div>
      <div class="absolute inset-y-0 right-0 flex items-center pr-2 sm:static sm:inset-auto sm:ml-6 sm:pr-0">
        <a
          href="/login"
          class="text-white bg-indigo-800 rounded-md px-4 py-2"
        >
          Sign in
        </a>

        <div class="ml-3 relative">
          <div>
            <a href="/register" class="bg-white text-indigo-800 rounded-md px-4 py-2">
              Sign up
            </a>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="hidden lg:hidden" id="mobile-menu">
    <div class="px-2 pt-2 pb-3 space-y-1">
      <a
        href="/"
        class="bg-indigo-600 text-white block px-3 py-2 rounded-md text-base font-medium"
        aria-current="page"
      >
        Home
      </a>

      <a
        href="/organizations"
        class="text-white hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
      >
        Organizations
      </a>

      <a
        href="/speakers"
        class="text-white hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
      >
        Speakers
      </a>

      <a
        href="/news"
        class="text-white hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
      >
        News
      </a>

      <a
        href="/about"
        class="text-white hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
      >
        About
      </a>

      <a
        href="/contact"
        class="text-white hover:bg-indigo-600 hover:text-white block px-3 py-2 rounded-md text-base font-medium"
      >
        Contact
      </a>
    </div>
  </div>
</nav>