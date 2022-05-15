@extends('layouts.app')

@section('content')
  <div class="container mx-auto lg:w-[917px] px-5 md:px-0">
    <div class="bg-white px-8 pt-8 pb-16 lg:px-12 rounded-20 shadow-xl mt-9">
      <x-back-button name="organizations" url="{{ route('organizations') }}" />
      <div class="flex gap-8 mt-8 flex-wrap md:flex-nowrap">
        <img src="{{ $organization->logoPath }}" alt="{{ $organization->name }} logo"
          class="w-[200px] h-[180px] rounded-10 object-cover" />
        <div class="w-full">
          <div class="flex justify-between flex-wrap">
            <h2 class="text-2xl font-bold">
              {{ $organization->name }}
            </h2>
            <div class="flex items-center gap-5">
              @foreach ($organization->organizationProfiles as $profile)
                <a href="{{ $profile->link }}" class="text-gray-600"><i class="{{ $profile->getIconPath() }} fa-xl"></i></a>
              @endforeach
            </div>
          </div>
          <div class="flex justify-between gap-x-9 gap-y-4 text-gray-500 mt-5 flex-wrap">
            <div class="flex items-center gap-2">
              <i class="fa-solid fa-microchip fa-lg"></i>
              <p>{{ $organization->organizationType }}</p>
            </div>
            <div class="flex items-center gap-2">
              <i class="fa-solid fa-users fa-lg"></i>
              <p>{{ $organization->numberOfEmployees }}</p>
            </div>
            <div class="flex items-center gap-2">
              <i class="fa-solid fa-location-dot fa-lg"></i>
              <p>{{ $organization->location }}</p>
            </div>
            <div class="flex items-center gap-2">
              <i class="fa-solid fa-landmark fa-lg"></i>
              <p>{{ $organization->foundationDate }}</p>
            </div>
          </div>
        </div>
      </div>
      <h3 class="text-2xl font-bold mt-16">About Organization</h3>
      <p class="mt-2 leading-7">{{ $organization->description }}</p>
      <h3 class="text-2xl font-bold mt-16">Contact</h3>
      <div class=" lg:col-span-2 ">
        <form action="#" method="post" class="mt-6 grid grid-cols-1 gap-y-6 sm:grid-cols-2 sm:gap-x-8">
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
              class="mt-2 w-full inline-flex items-center justify-center px-6 py-3 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-indigo-800 hover:bg-indigo-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:w-auto">
              Submit
            </button>
          </div>
        </form>
        <h3 class="text-2xl font-bold mt-10">Upcoming meetups</h3>
        <div class="grid md:grid-cols-2 lg:grid-cols-3 mt-10 gap-y-8">
          @forelse ($organization->meetups as $meetup)
            <a href="{{ route('meetups.show', $meetup) }}" class="w-[229px] h-[194px] rounded-2xl bg-white shadow-lg">
              <img src="{{ $meetup->logoPath }}" alt="{{ $meetup->title }} meetup" class="h-[105px] w-full object-cover rounded-t-20" />
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
  </div>
@endsection
