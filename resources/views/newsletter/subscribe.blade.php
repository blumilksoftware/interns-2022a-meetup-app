@extends('layouts.app')

@section('content')
  <div class="py-16 sm:py-24">
    <div class="relative sm:py-16">
      <div class="mx-auto max-w-md px-4 sm:max-w-3xl sm:px-6 lg:max-w-7xl lg:px-8">
        <div class="relative rounded-2xl px-6 py-10 bg-indigo-600 overflow-hidden shadow-xl sm:px-12 sm:py-20">
          <div aria-hidden="true" class="absolute inset-0 -mt-72 sm:-mt-32 md:mt-0">
            <svg class="absolute inset-0 h-full w-full" preserveAspectRatio="xMidYMid slice"
              xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 1463 360">
              <path class="text-indigo-500 text-opacity-40" fill="currentColor"
                d="M-82.673 72l1761.849 472.086-134.327 501.315-1761.85-472.086z" />
              <path class="text-indigo-700 text-opacity-40" fill="currentColor"
                d="M-217.088 544.086L1544.761 72l134.327 501.316-1761.849 472.086z" />
            </svg>
          </div>
          <div class="relative">
            <div class="sm:text-center">
              <h2 class="text-3xl font-extrabold text-white tracking-tight sm:text-4xl">What would you like to subscribe?
              </h2>
              <p class="mt-6 mx-auto max-w-2xl text-lg text-indigo-200">Please, feel free to choose your preference!</p>
            </div>
            <form action="{{ route('newsletter.update') }}" class="mt-12 sm:mx-auto sm:max-w-lg" method="post">
              @csrf
              <input type="email" hidden="hidden" name="email" id="email" value="{{ $subscriber->email }}">
              <fieldset class="border-t border-b border-indigo-200">
                <legend class="sr-only">Notifications</legend>
                <div class="divide-y divide-gray-200">
                  <div class="relative flex items-start py-4">
                    <div class="min-w-0 flex-1 text-sm">
                      <label for="meetups" class="font-medium text-white">New Meetups</label>
                      <p id="mettups-description" class="text-indigo-200">Get notified about new meetups that might
                        interest you</p>
                    </div>
                    <div class="ml-3 flex items-center h-5">
                      <input id="meetups" name="type[]" checked type="checkbox" value="{{ AvailableNewsletter::Meetups->value }}"
                        class="h-5 w-5 bg-indigo-500 text-indigo-500 rounded border-2 border-indigo-200 checked:bg-indigo-500 checked:border-indigo-200 checked:border-2">
                    </div>
                  </div>
                  <div class="relative flex items-start py-4">
                    <div class="min-w-0 flex-1 text-sm">
                      <label for="news" class="font-medium text-white">New News</label>
                      <p id="news-description" class="text-indigo-200">Get notified about news that might interest you
                      </p>
                    </div>
                    <div class="ml-3 flex items-center h-5">
                      <input id="news" name="type[]" type="checkbox" value="{{ AvailableNewsletter::News->value }}"
                        class="h-5 w-5 bg-indigo-500 text-indigo-500 rounded border-2 border-indigo-200 checked:bg-indigo-500 checked:border-indigo-200 checked:border-2">
                    </div>
                  </div>
                  <x-input-error for="type" />
                </div>
              </fieldset>
              <button
                class="block w-[45%] rounded-md border border-transparent px-5 py-3 bg-white text-base font-medium text-indigo-600 shadow hover:bg-indigo-100 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600 sm:px-10 mt-5 mx-auto">Subscribe</button>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
