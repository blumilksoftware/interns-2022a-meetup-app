@extends('layouts.app')

@section('content')
<div class="container lg:w-[914px] mx-auto mt-12 px-5 md:px-0">
    <div class="bg-white w-full px-10 lg:px-[75px] pt-8 pb-16 shadow-xl rounded-20">
        <x-back-button name="news" url="{{ route('news') }}" />
      <h2 class="text-4xl font-medium mt-8">
        {{ $news->title }}
      </h2>
      <img
        src="{{ asset('static/images/news.webp') }}"
        alt="news_details_image"
        class="mt-8 w-full h-[337px] rounded-10 object-cover"
      />
      <p class="mt-16 leading-6">
        {!! Str::markdown($news->text) !!}
      </p>
      <div class="mt-12 flex gap-10 gap-y-5 flex-wrap">
        <h3>Tags:</h3>
        <a href="#" class="text-indigo-600">
          Artificial Intelligence
        </a>
        <a href="#" class="text-indigo-600">
          AI
        </a>
        <a href="#" class="text-indigo-600">
          Technology
        </a>
        <a href="#" class="text-indigo-600">
          Technology
        </a>
        <a href="#" class="text-indigo-600">
          Technology
        </a>
        <a href="#" class="text-indigo-600">
          Technology
        </a>
        <a href="#" class="text-indigo-600">
          Technology
        </a>
        <a href="#" class="text-indigo-600">
          Technology
        </a>
        <a href="#" class="text-indigo-600">
          Technology
        </a>
        <a href="#" class="text-indigo-600">
          Technology
        </a>
        <a href="#" class="text-indigo-600">
          Technology
        </a>
      </div>
      <p class="mt-7">Share this article on:</p>
      <div class="flex gap-10 mt-2 flex-wrap">
        <button class="bg-[#4267B2] px-4 py-2 font-semibold text-white inline-flex items-center space-x-2 rounded">
            <i class="fa-brands fa-facebook fa-lg"></i>
          <span>Facebook</span>
        </button>
        <button class="bg-[#3C9CF3] px-4 py-2 font-semibold text-white inline-flex items-center space-x-2 rounded">
            <i class="fa-brands fa-twitter fa-lg"></i>
          <span>Twitter</span>
        </button>
        <button class="bg-[#2473B6] px-4 py-2 font-semibold text-white inline-flex items-center space-x-2 rounded">
            <i class="fa-brands fa-linkedin fa-lg"></i>
          <span>Linkedin</span>
        </button>
      </div>
    </div>
  </div>
@endsection
