@extends('layouts.app')

@section('content')
  <div class="container sm:w-[1216px] mx-auto px-5 xl:px-0" x-data="{ sortDropdownOpened: false }">
    <h2 class="text-3xl font-bold mt-16">Organizations</h2>
    <div class="flex items-center mt-11 gap-7 flex-wrap">
      <div class="relative text-gray-600">
        <input class="border-2 border-gray-300 bg-white h-10 px-10 pr-16 rounded-lg text-sm focus:outline-none w-96"
          type="search" name="search" placeholder="Search" />
        <button type="submit" class="absolute left-3 -top-3 mt-5 mr-4">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>
      <div class="gap-5 relative">
        <div>
          <button @click="sortDropdownOpened = !sortDropdownOpened"
                  class="bg-white drop-shadow-filter p-2 rounded-lg flex">
              <p>Sort by:
                  @sortablelink(Request::get("sort"), str_replace("_"," ", Request::get("sort")))
              </p>
            <span><i class="fa-solid fa-chevron-down fa-lg ml-3"></i></span>
          </button>
        </div>
        <div x-show="sortDropdownOpened" x-cloak x-transition
             class="origin-top-right absolute right-0 mt-2 w-auto rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
             id="organizations-sort-menu" role="menu" aria-orientation="vertical" aria-labelledby="organizations-sort-menu-button"
             tabindex="-1">
             <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                role="menuitem" tabindex="-1" id="sort-menu-item-0">
                 @sortablelink('name')
             </span>
             <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                role="menuitem" tabindex="-1" id="sort-menu-item-1">
                 @sortablelink('location')
             </span>
             <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                role="menuitem" tabindex="-1" id="sort-menu-item-2">
                 @sortablelink('organization_type', 'Organization type')
             </span>
             <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                role="menuitem" tabindex="-1" id="sort-menu-item-3">
                 @sortablelink('foundation_date', 'Foundation date')
             </span>
             <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                role="menuitem" tabindex="-1" id="sort-menu-item-4">
                 @sortablelink('number_of_employees', 'Number of employees')
             </span>
        </div>
      </div>
      <x-input-limits-pagination />
    </div>
    <ul class="mt-11">
      @forelse ($organizations as $organization)
        <li class="mt-12">
          <a href="{{ route('organizations.show', $organization) }}">
            <div class="bg-white flex flex-wrap md:flex-nowrap gap-9 shadow-lg md:h-[218px] rounded-20 overflow-hidden">
              <img src="{{ $organization->logoPath }}" alt="{{ $organization->name }} image"
                class="w-full rounded-t-20 md:w-[361px] md:h-[218px] md:rounded-l-20 md:rounded-tr-none object-cover" />
              <div class="w-[500px] px-8">
                <h3 class="text-2xl md:mt-10 font-bold">
                  {{ $organization->name }}
                </h3>
                <div class="h-60 md:h-[110px] overflow-hidden">
                  <p class="text-gray-400 mt-5">
                    {{ $organization->description }}
                  </p>
                </div>
              </div>
            </div>
          </a>
        </li>
      @empty
        <p class="text-xl text-center">There are no organizations</p>
      @endforelse
    </ul>
    <div class="mt-10">
      {{ $organizations->appends(Request::except('page'))->links('vendor.pagination.tailwind') }}
    </div>
  </div>
@endsection
