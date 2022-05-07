@extends('layouts.app')

@section('content')
  <div class="container lg:w-[860px] mx-auto mt-16 px-5 md:px-0">
    <div class="bg-white px-12 pt-8 pb-16 rounded-20 shadow-xl">
      <x-back-button name="speaker list" url="{{ route('speakers') }}" />
      <div class="flex gap-9 items-start mt-8">
        <img src="{{ $speaker->avatarPath }}" alt="{{ $speaker->name }} avatar" class="w-32 h-32 rounded-full" />
        <div class="">
          <p class="text-3xl">{{ $speaker->name }}</p>
          <p class="mt-1">Frontend developer</p>
          <div class="flex gap-x-16 gap-y-3 text-gray-500 mt-2 flex-wrap">
            <a href="#" class="flex items-center gap-3">
              <i class="fa-brands fa-facebook-f fa-lg"></i>
              <p>{{ $speaker->name }}</p>
            </a>
            <a href="{{ $speaker->linkedinUrl }}" class="flex items-center gap-2">
              <i class="fa-brands fa-linkedin fa-lg"></i>
              <p>{{ $speaker->name }}</p>
            </a>
            <a href="{{ $speaker->githubUrl }}" class="flex items-center gap-2">
              <i class="fa-brands fa-github fa-lg"></i>
              <p>{{ $speaker->name }}</p>
            </a>
          </div>
        </div>
      </div>
      <h3 class="text-2xl font-bold mt-20">About Me</h3>
      <p class="leading-6">
        {{ $speaker->description }}
      </p>
      <div class="flex flex-col gap-7 mt-12">
        <div class="flex items-center gap-4">
          <i class="fa-solid fa-location-dot fa-lg"></i>
          <p>Warsaw</p>
        </div>
        <a href="tel:123-456-7890" class="flex items-center gap-4">
          <i class="fa-solid fa-phone fa-lg"></i>
          <p>+48 123 456 789</p>
        </a>
        <a href="mailto:user@example.com" class="flex items-center gap-4">
          <i class="fa-solid fa-envelope fa-lg"></i>
          user@gmail.com
        </a>
      </div>

      <h3 class="text-2xl font-bold mt-16">Contact</h3>
      <div class=" lg:col-span-2">
        <form action="#" method="POST" class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
          <div class="sm:col-span-2">
            <div class="mt-1">
              <input type="text" name="subject" id="subject" placeholder="Full Name"
                class="py-3 px-4 block w-full shadow-sm text-warm-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border-warm-gray-300 rounded-md" />
            </div>
          </div>
          <div>
            <div class="mt-1">
              <input type="email" name="first-name" id="first-name" placeholder="Email" autocomplete="given-name"
                class="py-3 px-4 block w-full shadow-sm text-warm-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border-warm-gray-300 rounded-md" />
            </div>
          </div>
          <div>
            <div class="mt-1">
              <input type="text" name="last-name" id="last-name" placeholder="Phone number" autocomplete="family-name"
                class="py-3 px-4 block w-full shadow-sm text-warm-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border-warm-gray-300 rounded-md" />
            </div>
          </div>

          <div class="sm:col-span-2">
            <div class="flex justify-end">
              <span id="message-max" class="text-sm text-warm-gray-500">
                Max. 500 characters
              </span>
            </div>
            <div class="mt-1">
              <textarea id="message" name="message" rows="4" placeholder="Message"
                class="py-3 px-4 block w-full shadow-sm text-warm-gray-900 focus:ring-indigo-500 focus:border-indigo-500 border border-warm-gray-300 rounded-md"
                aria-describedby="message-max"></textarea>
            </div>
          </div>
          <div class="sm:col-span-2 sm:flex">
            <button type="submit"
              class="mt-2 w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-600 hover:bg-indigo-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto">
              Submit
            </button>
          </div>
        </form>
      </div>
      <h3 class="text-2xl font-bold mt-16">Meetups</h3>
      <div class="mt-6">
        <button class="py-3 px-4 bg-indigo-600 text-white rounded-20">
          Upcoming (3)
        </button>
        <button class="py-3 px-4 border border-black rounded-20 ml-4">
          Past (1)
        </button>
      </div>
      <div class="grid md:grid-cols-2 lg:grid-cols-3 mt-10 gap-y-8">
        @forelse ($speaker->meetups as $meetup)
          <a href="{{ route('meetups.show', $meetup) }}" class="w-[229px] h-[194px] rounded-2xl bg-white shadow-lg">
            <img src="{{ $meetup->logoPath }}" alt="{{ $meetup->title }} meetup"
              class="h-[105px] w-full object-cover rounded-t-20" />
            <div class="flex justify-between px-5">
              <div class="flex flex-col h-[100px] justify-around">
                <p class="text-sm w-40">{{ $meetup->title }}</p>
                <p class="text-xs text-gray-500 -mt-3">
                  <i class="fa-regular fa-clock mr-2"></i>
                  {{ $meetup->date }}
                </p>
                <p class="text-xs text-gray-500 -mt-3 mb-3">
                  <i class="fa-solid fa-location-dot mr-2"></i>
                  {{ $meetup->place }}
                </p>
              </div>
              <div class="text-sm text-center mt-1">
                <p class="text-red-500">Feb</p>
                <p>24</p>
              </div>
            </div>
          </a>
        @empty
          <p class="text-center">There are no meetups</p>
        @endforelse
      </div>
    </div>
  </div>
@endsection
