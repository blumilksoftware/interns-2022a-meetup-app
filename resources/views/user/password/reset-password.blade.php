@extends('layouts.app')

@section('content')
  <div class="container mx-auto">
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-lg">
        <div class="bg-white pt-2 pb-8 px-4 shadow sm:rounded-20 sm:px-10">
          <form class="space-y-6" action="{{ route('password.update') }}" method="post">
            @csrf
            <div>
              <h1 class="text-xl">Reset Password</h1>
            </div>
            @if (!empty($error))
              <div class="relative text-red-500 -top-6 left-1/2 transform -translate-x-1/2">
                {{ $error }}
              </div>
            @endif
            <div>
              <input type="string" id="token" hidden="hidden" name="token" value="{{ $token }}">
              <x-input-error for="token" />
            </div>
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">
                Email
              </label>
              <div class="mt-1">
                <input id="email" name="email" type="email" placeholder="example@example.com" value="{{ $email }}" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                  readonly="readonly" />
                <x-input-error for="email" />
              </div>
            </div>
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700">
                Enter new password
              </label>
              <div class="mt-1">
                <input id="password" name="password" type="password" value="{{ old('password') }}"
                  placeholder="********" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                <x-input-error for="password" />
              </div>
            </div>

            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                Confirm new password
              </label>
              <div class="mt-1">
                <input id="password_confirmation" name="password_confirmation" type="password" placeholder="********"
                  value="{{ old('password_confirmation') }}" required
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                <x-input-error for="password_confirmation" />
              </div>
            </div>

            <div>
              <button
                class="w-72 mx-auto flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Reset password
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
