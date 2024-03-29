@extends('layouts.app')

@section('content')
  <div class="container md:w-[800px] mx-auto">
    @auth
      <form method="post" action="" enctype="multipart/form-data" class="bg-white p-6 mt-20 rounded-20 shadow-xl">
        @method('PATCH')
        @csrf
        <div>
          <div>
            @if (!empty($error))
              <div class="relative text-red-500 -top-6 left-1/2 transform -translate-x-1/2">
                {{ $error }}</div>
            @endif
            <h3 class="text-xl leading-6 font-medium text-gray-900">
              Change password
            </h3>
          </div>
          <div>
            <div class="mt-5">
              <label for="password" class="block text-sm font-medium text-gray-700">
                Current Password
              </label>
              <div class="mt-1">
                <input id="password" name="password" type="password" value="{{ old('password') }}" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                <x-input-error for="password" />
              </div>
            </div>
            <div class="mt-5">
              <label for="new_password" class="block text-sm font-medium text-gray-700">
                New Password
              </label>
              <div class="mt-1">
                <input id="new_password" name="new_password" type="password" value="{{ old('new_password') }}" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                <x-input-error for="new_password" />
              </div>
            </div>
            <div class="mt-5">
              <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700">
                Confirm New Password
              </label>
              <div class="mt-1">
                <input id="new_password_confirmation" name="new_password_confirmation" type="password" required
                  value="{{ old('new_password_confirmation') }}"
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                <x-input-error for="new_password_confirmation" />
              </div>
            </div>
          </div>
        </div>
        <div class="pt-6">
          <div class="flex justify-end">
            <a href="{{ route('user.profile') }}"
              class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Cancel
            </a>
            <button type="submit"
              class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
              Update
            </button>
          </div>
        </div>
      </form>
    @endauth
  </div>
@endsection
