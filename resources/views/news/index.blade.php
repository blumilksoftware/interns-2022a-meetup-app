@extends('layouts.app')

@section('content')
  <div class="container md:w-[1216px] mx-auto mt-16">
    <h2 class="text-3xl font-bold">News</h2>
    <div class="md:flex mt-3 text-white">
      <a href="#" class="w-1/2 relative">
        <img src={{ asset('static/images/news_list.webp') }} alt="news" class="w-full h-[450px] object-cover" />
        <div class="absolute w-[500px] md:w-auto top-64 md:top-52 lg:bottom-0 lg:top-auto z-10 p-10">
          <h3 class="text-2xl font-bold">
            OpenAI is Making Coding As Easy As Talking to a Smart Speaker
          </h3>
          <p>
            Plus: The early days of programming, an existential
            investigations, and bipartisanship before our eyes
          </p>
        </div>
        <div class="absolute w-full h-full inset-0 bg-gradient-to-t from-white to-black opacity-20"></div>
      </a>
      <div class="w-1/2">
        <a href="#" class="w-1/2 relative">
          <div class="relative">
            <img src={{ asset('static/images/news_list.webp') }} alt="news" class="w-full h-[225px] object-cover" />
            <div class="absolute bottom-0 z-10 px-7 py-3">
              <h3 class="text-xl font-bold leading-6">
                OpenAI is Making Coding As Easy As Talking to a Smart Speaker
              </h3>
              <p class="leading-5">
                Plus: The early days of programming, an existential
                investigations, and bipartisanship before our eyes
              </p>
            </div>
            <div class="absolute w-full h-full inset-0 bg-gradient-to-t from-white to-black opacity-20"></div>
          </div>
        </a>
        <div class="flex">
          <a href="#" class="relative w-full">
            <img src={{ asset('static/images/news_list.webp') }} alt="news" class="w-full h-[225px] object-cover" />
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
            <img src={{ asset('static/images/news_list.webp') }} alt="news" class="w-full h-[225px] object-cover" />
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
          </a>
        </div>
      </div>
    </div>
    <div class="px-5">
      <ul class="mt-12 relative">
        @forelse ($news as $singleNews)
          <li class="mt-7">
            <a href="#">
              <div class="bg-white flex flex-wrap md:flex-nowrap items-center gap-9 shadow-lg rounded-20">
                <img src={{ asset('static/images/news_list.webp') }} alt="news_image"
                  class="w-full rounded-t-20 md:w-[361px] md:h-[218px] md:rounded-l-20 md:rounded-tr-none object-cover" />
                <div class="w-[500px] px-8 pb-5 md:pb-0">
                  <h3 class="text-xl font-bold">
                    {{ $singleNews->title }}
                  </h3>
                  <p class="text-gray-400 mt-5">
                    {!! Str::markdown($singleNews->text) !!}
                  </p>
                </div>
              </div>
            </a>
          </li>
        @empty
          <li class="text-xl left-1/2 transform -translate-x-1/2 absolute top-4">There is no news!</li>
        @endforelse
      </ul>
      <div class="mt-10">
        {{ $news->links('vendor.pagination.tailwind') }}
      </div>
    </div>
  </div>
@endsection
