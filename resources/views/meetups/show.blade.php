@extends('layouts.app')

@section('content')
  <div class="container xl:w-[1017px] mx-auto px-5 md:px-0">
    <div class="lg:flex justify-between mt-10">
      <div class="bg-white lg:w-[680px] px-6 md:px-12 pt-6 pb-12 rounded-20 shadow-xl">
        <x-back-button name="meetups" url="{{ route('meetups') }}" />
        <h2 class="text-2xl font-bold mt-6">{{ $meetup->title }}</h2>
        <img src="{{ $meetup->logoPath }}" class="mt-3 w-full h-[200px] rounded-10 object-cover" alt="{{ $meetup->title }} logo" />
        <div class="flex justify-between">
          <div class="mt-9 flex items-center">
            <i class="fa-solid fa-layer-group fa-lg"></i>
            <p class="ml-3">IT</p>
          </div>
          <div class="mt-9 flex items-center">
            <i class="fa-solid fa-graduation-cap fa-lg"></i>
            <p class="ml-3">Programming</p>
          </div>
          <div class="mt-9 flex items-center">
            <i class="fa-solid fa-earth-americas fa-lg"></i>
            <p class="ml-3">Polish</p>
          </div>
          <div class="mt-9 flex items-center">
            <i class="fa-solid fa-dollar-sign fa-lg"></i>
            <p class="ml-3">Free</p>
          </div>
        </div>
        <h3 class="mt-9 text-2xl font-bold">About Meetup</h3>
        <p>{{ $meetup->description }}</p>
      </div>
      <div class="lg:w-[287px] mt-8 lg:mt-0 lg:block justify-between items-start">
        <div class="bg-white px-5 py-6 rounded-10 shadow-lg">
          <div class="flex items-center gap-7">
            <i class="fa-regular fa-clock fa-lg"></i>
            <p>{{ $meetup->date }}</p>
          </div>
          <div class="flex items-center gap-7 mt-4">
            <i class="fa-solid fa-location-dot fa-lg"></i>
            <p>{{ $meetup->place }}</p>
          </div>
        </div>
        <div class="bg-white px-5 py-6 rounded-10 mt-8 shadow-lg">
          <h4>Speakers</h4>
          <ul class="mt-2">
            @forelse ($meetup->speakers as $speaker)
              <li class="mt-2">
                <a href="{{ route('speakers.show', $speaker) }}">
                  <div class="flex items-center gap-4 mt-2">
                    <img src="{{ $speaker->avatarPath }}" alt="{{ $speaker->name }} avatar" class="w-16 h-16 rounded-full object-fit" />
                    <p>{{ $speaker->name }}</p>
                  </div>
                </a>
              </li>
            @empty
              <li>There are no speakers</li>
            @endforelse
          </ul>
        </div>
      </div>
    </div>
  </div>
@endsection
