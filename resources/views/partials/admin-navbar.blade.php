<div class="relative z-40 md:hidden" role="dialog" aria-modal="true">
  <div class="fixed inset-0 bg-gray-600 bg-opacity-75"></div>
  <div class="fixed inset-0 flex z-40">
    <div class="relative flex-1 flex flex-col max-w-xs w-full pt-5 pb-4 bg-indigo-800">
      <div class="absolute top-0 right-0 -mr-12 pt-2">
        <button type="button"
          class="ml-1 flex items-center justify-center h-10 w-10 rounded-full focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white">
          <span class="sr-only">Close sidebar</span>
          <i class="fa-solid fa-x text-white"></i>
        </button>
      </div>
      <div class="mt-5 flex-1 h-0 overflow-y-auto">
        <nav class="px-2 space-y-1">
          <a href="{{ route('admin.dashboard') }}"
            class="{{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 text-white group flex items-center px-2 py-2 text-base font-medium rounded-md">
            <i class="fa-solid fa-table-columns fa-lg mr-6"></i>
            Dashboard
          </a>
          <a href="#"
            class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">
            <i class="fa-solid fa-circle-question fa-lg mr-6"></i>
            Logo
          </a>
          <a href="{{ route('admin.users') }}"
            class="{{ request()->routeIs('admin.users') ? 'bg-indigo-600' : '' }} text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">
            <i class="fa-solid fa-users fa-lg mr-5"></i>
            Users
          </a>
          <a href="{{ route('admin.meetups') }}"
            class="{{ request()->routeIs('admin.meetups') ? 'bg-indigo-600' : '' }} text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">
            <i class="fa-solid fa-calendar-check fa-lg mr-6"></i>
            Meetups
          </a>
          <a href="{{ route('admin.organizations') }}"
            class="{{ request()->routeIs('admin.organizations') ? 'bg-indigo-600' : '' }} text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">
            <i class="fa-solid fa-sitemap fa-lg mr-5"></i>
            Organizations
          </a>
          <a href="{{ route('admin.speakers') }}"
            class="{{ request()->routeIs('admin.speakers') ? 'bg-indigo-600' : '' }} text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">
            <i class="fa-solid fa-microphone fa-lg mr-6"></i>
            Speakers
          </a>
          <a href="{{ route('admin.news') }}"
            class="{{ request()->routeIs('admin.news') ? 'bg-indigo-600' : '' }} text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-base font-medium rounded-md">
            <i class="fa-solid fa-newspaper fa-lg mr-6"></i>
            News
          </a>
        </nav>
      </div>
    </div>
  </div>
</div>
<div class="hidden md:flex md:w-64 md:flex-col md:fixed md:inset-y-0">
  <div class="flex flex-col flex-grow pt-5 bg-indigo-800 overflow-y-auto">
    <div class="mt-12 flex-1 flex flex-col">
      <nav class="flex-1 px-2 pb-4 space-y-1">
        <a href="{{ route('admin.dashboard') }}"
          class="{{ request()->routeIs('admin.dashboard') ? 'bg-indigo-600' : '' }} hover:bg-indigo-600 text-white group flex items-center px-2 py-2 text-sm font-medium rounded-md">
          <i class="fa-solid fa-table-columns fa-lg mr-6"></i>
          Dashboard
        </a>
        <a href="#"
          class="text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
          <i class="fa-solid fa-circle-question fa-lg mr-6"></i>
          Logo
        </a>
        <a href="{{ route('admin.users') }}"
          class="{{ request()->routeIs('admin.users') ? 'bg-indigo-600' : '' }} text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
          <i class="fa-solid fa-users fa-lg mr-5"></i>
          Users
        </a>
        <a href="{{ route('admin.meetups') }}"
          class="{{ request()->routeIs('admin.meetups') ? 'bg-indigo-600' : '' }} text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
          <i class="fa-solid fa-calendar-check fa-lg mr-6"></i>
          Meetups
        </a>
        <a href="{{ route('admin.organizations') }}"
          class="{{ request()->routeIs('admin.organizations') ? 'bg-indigo-600' : '' }} text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
          <i class="fa-solid fa-sitemap fa-lg mr-5"></i>
          Organizations
        </a>
        <a href="{{ route('admin.speakers') }}"
          class="{{ request()->routeIs('admin.speakers') ? 'bg-indigo-600' : '' }} text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
          <i class="fa-solid fa-microphone fa-lg mr-6"></i>
          Speakers
        </a>
        <a href="{{ route('admin.news') }}"
          class="{{ request()->routeIs('admin.news') ? 'bg-indigo-600' : '' }} text-indigo-100 hover:bg-indigo-600 group flex items-center px-2 py-2 text-sm font-medium rounded-md">
          <i class="fa-solid fa-newspaper fa-lg mr-6"></i>
          News
        </a>
      </nav>
    </div>
  </div>
</div>
