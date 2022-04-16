@extends('layouts.app')

@section('content')
    <div class="container lg:w-[933px] mx-auto">
        <div class="md:flex mt-12 px-10 sm:mx-auto sm:w-full sm:max-w-md md:px-0 md:max-w-none">
            <div
                class="relative w-full h-[500px] rounded-t-20 md:w-[485px] md:h-auto md:justify-self-stretch md:rounded-l-20 md:rounded-tr-none bg-login bg-cover">
                <div class="absolute inset-0 bg-indigo-600 opacity-40 rounded-t-20 md:rounded-l-20 md:rounded-tr-none">
                </div>
                <h1
                    class="absolute top-1/2 left-1/2 text-white text-6xl font-extrabold transform -translate-x-1/2 -translate-y-1/2 text-center leading-relaxed">
                    Sign in
                    <br />
                    to Meetup
                </h1>
            </div>
            <div class="sm:mx-auto sm:w-full sm:max-w-md">
                <div class="bg-white px-10 shadow rounded-b-20 sm:px-5  md:rounded-bl-none md:rounded-r-20">
                    <div class="min-h-full flex flex-col justify-center py-10 sm:px-6 lg:px-8">
                        <div class="sm:mx-auto sm:w-full sm:max-w-md">
                            <img class="mx-auto h-12 w-auto"
                                src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow" />
                            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                                Sign in to your account
                            </h2>
                        </div>
                        <form action="{{ route('login') }}" class="space-y-6 mt-12 relative" action="#" method="POST">
                            @csrf
                            @if (!empty($error))
                                <div class="absolute text-red-500 -top-6 left-1/2 transform -translate-x-1/2">{{ $error }}</div>
                            @endif
                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email address
                                </label>
                                <div class="mt-1">
                                    <input id="email" name="email" type="email" autocomplete="email"
                                        value="{{ old('email') }}" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                    <x-input-error for="email" />
                                </div>
                            </div>

                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Password
                                </label>
                                <div class="mt-1">
                                    <input id="password" name="password" type="password" value="{{ old('password') }}"
                                        autocomplete="current-password" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                    <x-input-error for="password" />
                                </div>
                            </div>

                            <div class="flex items-center justify-between">
                                <div class="flex items-center">
                                    <input id="remember-me" name="remember-me" type="checkbox"
                                        class="h-4 w-4 text-indigo-600 focus:ring-indigo-500 border-gray-300 rounded" />
                                    <label for="remember-me" class="ml-2 block text-sm text-gray-900">
                                        Remember me
                                    </label>
                                </div>

                                <div class="text-sm">
                                    <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500">
                                        Forgot your password?
                                    </a>
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Sign in
                                </button>
                            </div>
                        </form>

                        <div class="mt-6">
                            <div class="relative">
                                <div class="absolute inset-0 flex items-center">
                                    <div class="w-full border-t border-gray-300"></div>
                                </div>
                                <div class="relative flex justify-center text-sm">
                                    <span class="px-2 bg-white text-gray-500">Or</span>
                                </div>
                            </div>

                            <div class="mt-6 text-center">
                                <a href="{{ route('login.google') }}" type="button"
                                    class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2 w-full justify-center md:w-auto">
                                    <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab"
                                        data-icon="google" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 488 512">
                                        <path fill="currentColor"
                                            d="M488 261.8C488 403.3 391.1 504 248 504 110.8 504 0 393.2 0 256S110.8 8 248 8c66.8 0 123 24.5 166.3 64.9l-67.5 64.9C258.5 52.6 94.3 116.6 94.3 256c0 86.5 69.1 156.6 153.7 156.6 98.2 0 135-70.4 140.8-106.9H248v-85.3h236.1c2.3 12.7 3.9 24.9 3.9 41.4z">
                                        </path>
                                    </svg>
                                    Sign in with Google
                                </a>
                                <a href="{{ route('login.facebook') }}" type="button"
                                    class="text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 mr-2 mb-2 mt-3 w-full justify-center md:w-auto">
                                    <svg class="w-4 h-4 mr-2 -ml-1" aria-hidden="true" focusable="false" data-prefix="fab"
                                        data-icon="facebook-f" role="img" xmlns="http://www.w3.org/2000/svg"
                                        viewBox="0 0 320 512">
                                        <path fill="currentColor"
                                            d="M279.1 288l14.22-92.66h-88.91v-60.13c0-25.35 12.42-50.06 52.24-50.06h40.42V6.26S260.4 0 225.4 0c-73.22 0-121.1 44.38-121.1 124.7v70.62H22.89V288h81.39v224h100.2V288z">
                                        </path>
                                    </svg>
                                    Sign in with Facebook
                                </a>
                            </div>
                            <p class="text-center mt-7">Don't have and account? <a href="{{ route('register') }}"
                                    class="text-indigo-600">Register
                                    now</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
