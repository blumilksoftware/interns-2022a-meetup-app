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
              <h2 class="text-3xl font-extrabold text-white tracking-tight sm:text-4xl">Subscribe to our newsletter</h2>
              <p class="mt-6 mx-auto max-w-2xl text-lg text-indigo-200">And start getting information about meetups and news</p>
            </div>
            <form class="mt-12 sm:mx-auto sm:max-w-lg" method="post">
              <div class="min-w-0 flex-1">
                <label for="cta-email" class="sr-only">Email address</label>
                <input id="cta-email" type="email"
                  class="block w-full border border-transparent rounded-md px-5 py-3 text-base text-gray-900 placeholder-gray-500 shadow-sm focus:outline-none focus:border-transparent focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600"
                  placeholder="Enter your email">
              </div>
              <div class="mt-5 flex justify-between">
                <button
                  class="block w-[45%] rounded-md border border-transparent px-5 py-3 bg-indigo-500 text-base font-medium text-white shadow hover:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600 sm:px-10">Subscribe</button>
                <button
                  class="block w-[45%] rounded-md border border-transparent px-5 py-3 bg-indigo-500 text-base font-medium text-white shadow hover:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-white focus:ring-offset-2 focus:ring-offset-indigo-600 sm:px-10">Unsubscribe</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
@endsection
