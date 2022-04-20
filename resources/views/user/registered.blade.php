@extends('layouts.app')

@section('content')
    <div class="h-screen text-black">
        <div class="flex justify-center flex-col items-center h-4/5">
            <i class="fa-regular fa-circle-check text-green-400 fa-8x"></i>
            <p class="text-3xl mt-8">Registration completed successfully</p>
            <p class="mt-2 text-lg">
                Please check your registered email for email verification
            </p>
            <a href="/login" class="w-48 mt-10 bg-indigo-600 text-white text-center p-4 rounded-lg">
                Go to login page
            </a>
        </div>
    </div>
@endsection
