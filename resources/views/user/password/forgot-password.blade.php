@extends('layouts.app')

@section('content')
  <div class="container mx-auto">
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
        <div class="bg-white pt-2 pb-8 px-4 shadow sm:rounded-20 sm:px-10">
          <form class="space-y-6" action="{{ route('password.email') }}" method="post">
            @csrf
            <div>
              <h1 class="text-xl">Forgot your password?</h1>
              <p class="text-gray-400 text-sm mt-1">
                Please enter the email adress and we will send you
                instructions to reset your password
              </p>
            </div>
            <div>
              <label for="email" class="block text-sm font-medium text-gray-700">
                Email address
              </label>
              <div class="mt-1">
                <input id="email" name="email" type="email" 
                placeholder="Email" autocomplete="email" required value="{{ old('email') }}"
                  class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                <x-input-error for="email" />
              </div>
            </div>
            <div>
              <button
                class="w-72 mx-auto flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Send reset link
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
@endsection
