@extends('layouts.app')

@section('content')
  <div class="container md:w-[1216px] mx-auto mt-16 px-5 md:px-0">
    <h2 class="text-3xl font-bold">News</h2>
    <div class="md:flex mt-3 text-white">
      <a href="#" class="w-1/2 relative">
        <img src="{{ asset('static/images/news_list.webp') }}" alt="news"
          class="w-full h-[450px] object-cover rounded-t-20 md:rounded-l-20 md:rounded-tr-none" />
        <div class="absolute w-[500px] md:w-auto top-64 md:top-52 lg:bottom-0 lg:top-auto z-10 p-10">
          <h3 class="text-2xl font-bold">
            OpenAI is Making Coding As Easy As Talking to a Smart Speaker
          </h3>
          <p>
            Plus: The early days of programming, an existential
            investigations, and bipartisanship before our eyes
          </p>
        </div>
        <div
          class="absolute w-full h-full inset-0 bg-gradient-to-t from-white to-black opacity-20 rounded-t-20 md:rounded-l-20 md:rounded-tr-none">
        </div>
      </a>
      <div class="md:w-1/2">
        <a href="#" class="w-1/2 relative">
          <div class="relative">
            <img src="{{ asset('static/images/news_list.webp') }}" alt="news"
              class="w-full h-[225px] object-cover md:rounded-tr-20" />
            <div class="absolute bottom-0 z-10 px-7 py-3">
              <h3 class="text-xl font-bold leading-6">
                OpenAI is Making Coding As Easy As Talking to a Smart Speaker
              </h3>
              <p class="leading-5">
                Plus: The early days of programming, an existential
                investigations, and bipartisanship before our eyes
              </p>
            </div>
            <div class="absolute w-full h-full inset-0 bg-gradient-to-t from-white to-black opacity-20 md:rounded-tr-20">
            </div>
          </div>
        </a>
        <div class="flex">
          <a href="#" class="relative w-full">
            <img src="{{ asset('static/images/news_list.webp') }}" alt="news"
              class="w-full h-[225px] object-cover rounded-bl-20 md:rounded-bl-none" />
            <div class="absolute bottom-0 z-10 px-5 py-3">
              <h3 class="text-lg font-bold leading-5">
                OpenAI is Making Coding As Easy As Talking to a Smart
                Speaker
              </h3>
              <p class="text-sm leading-4">
                Plus: The early days of programming, an existential
                investigations, and bipartisanship before our eyes
              </p>
            </div>
            <div class="absolute w-full h-full inset-0 bg-gradient-to-t from-white to-black opacity-20"></div>
          </a>
          <a href="#" class="relative w-full">
            <img src="{{ asset('static/images/news_list.webp') }}" alt="news"
              class="w-full h-[225px] object-cover rounded-br-20" />
            <div class="absolute bottom-0 z-10 px-5 py-3">
              <h3 class="text-lg font-bold leading-5">
                OpenAI is Making Coding As Easy As Talking to a Smart
                Speaker
              </h3>
              <p class="text-sm leading-4">
                Plus: The early days of programming, an existential
                investigations, and bipartisanship before our eyes
              </p>
            </div>
            <div class="absolute w-full h-full inset-0 bg-gradient-to-t from-white to-black opacity-20"></div>
          </a>
        </div>
      </div>
    </div>
    <div>
      <ul class="mt-12 relative">
        @forelse ($news as $singleNews)
          <li class="mt-7">
            <a href="#">
              <div class="bg-white flex flex-wrap md:flex-nowrap gap-9 shadow-lg rounded-20 md:h-56">
                <img src="{{ $singleNews->logoPath }}" alt="{{ $singleNews->title }} logo"
                  class="w-full rounded-t-20 md:w-96 md:h-full md:rounded-l-20 md:rounded-tr-none object-cover" />
                <div class="lg:w-[700px] px-8 pb-5 md:pb-0">
                  <h3 class="text-xl font-bold md:mt-10">
                    {{ $singleNews->title }}
                  </h3>
                  <div class="h-[110px] overflow-hidden">
                    <p class="text-gray-400 mt-5 break-all">
                      {!! Str::markdown($singleNews->text) !!}
                  </div>
                  </p>
                </div>
              </div>
            </a>
          </li>
        @empty
          <li class="text-xl text-center">There is no news!</li>
        @endforelse
      </ul>
      <div class="mt-10">
        {{ $news->links('vendor.pagination.tailwind') }}
      </div>
    </div>
  </div>
@endsection
