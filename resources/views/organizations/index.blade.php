@extends('layouts.app')

@section('content')
  <div class="container sm:w-[1216px] mx-auto px-5 xl:px-0">
    <h2 class="text-3xl font-bold mt-16">Organizations</h2>
    <div class="flex items-center mt-11 gap-7 flex-wrap">
      <div class="relative text-gray-600">
        <input class="border-2 border-gray-300 bg-white h-10 px-10 pr-16 rounded-lg text-sm focus:outline-none w-96"
          type="search" name="search" placeholder="Search" />
        <button type="submit" class="absolute left-3 -top-3 mt-5 mr-4">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>
      <div class="flex gap-5">
        <button class="bg-white drop-shadow-filter p-2 rounded-lg flex">
          <p>Sort by: Date</p>
          <span><i class="fa-solid fa-chevron-down fa-lg ml-3"></i></span>
        </button>
      </div>
    </div>
    <ul class="mt-11">
      @forelse ($organizations as $organization)
        <li class="mt-12">
          <a href="#">
            <div class="bg-white flex items-center flex-wrap md:flex-nowrap gap-9 shadow-lg rounded-20">
              <img src="{{ asset('/static/images/organization_logo.webp') }}" alt="news_image"
                class="w-full rounded-t-20 md:w-[361px] md:h-[218px] md:rounded-l-20 md:rounded-tr-none object-cover" />
              <div class="w-[500px] px-8 pb-5">
                <h3 class="text-2xl font-bold">
                  {{ $organization->name }}
                </h3>
                <p class="text-gray-400 mt-5">
                  We are a company that is difficult to label. On the one hand, NOVOMATIC Technologies
                  Poland is a medium-sized R&D center with approximately three hundred specialists.
                </p>
              </div>
            </div>
          </a>
        </li>
      @empty
        <p class="text-xl text-center absolute top-4">There are no organizations</p>
      @endforelse
    </ul>
    {{ $organizations->links('vendor.pagination.tailwind') }}
  </div>
@endsection
