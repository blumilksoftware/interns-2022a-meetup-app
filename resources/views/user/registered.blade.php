@extends('layouts.app')

@section('content')
    <div class="h-screen text-black">
        <div class="flex justify-center flex-col items-center h-4/5">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-40 w-40 text-green-400" fill="none" viewBox="0 0 24 24"
                stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
            </svg>
            <p class="text-3xl mt-5">Registration completed successfully</p>
            <p class="mt-2 text-lg">
                Please check your registered email for email verification
            </p>
            <a href="{{ route('login') }}" class="w-48 mt-10 bg-indigo-600 text-white text-center p-4 rounded-lg">
                Go to login page
            </a>
        </div>
    </div>
@endsection
