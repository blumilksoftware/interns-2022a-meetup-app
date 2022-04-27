@extends('layouts.app')

@section('content')
  <div className="container mx-auto">
    <div class="min-h-full flex flex-col justify-center py-12 sm:px-6 lg:px-8">
      <div class="mt-8 sm:mx-auto sm:w-full sm:max-w-xl">
        <div class="bg-white py-8 px-4 shadow sm:rounded-20 sm:px-10 text-center">
          <h3 className="text-2xl font-medium">Message</h3>
          <p className="mt-5 text-lg">
            {{ $status }}
          </p>
          <a href="{{ route('login') }}"
            className="w-48 block mx-auto mt-10 bg-indigo-600 text-white text-center p-3 rounded-lg hover:bg-indigo-700">
            Go to login page
          </a>
        </div>
      </div>
    </div>
  </div>
@endsection
