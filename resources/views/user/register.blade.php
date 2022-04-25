@extends('layouts.app')

@section('content')
    <div class="container lg:w-[1141px] mx-auto">
        <div class="md:flex mt-8 px-10 sm:mx-auto sm:w-full sm:max-w-md md:px-0 md:max-w-none">
            <div
                class="relative w-full h-[550px] md:h-[916px] lg:w-[591px] lg:h-auto bg-register bg-cover bg-center rounded-t-20 md:rounded-l-20 md:rounded-tr-none">
                <div class="absolute inset-0 bg-indigo-600 opacity-40 rounded-t-20 md:rounded-l-20 md:rounded-tr-none">
                </div>
                <h1
                    class="absolute top-1/2 left-1/2 text-white text-6xl font-extrabold transform -translate-x-1/2 -translate-y-1/2 text-center leading-relaxed">
                    Sign up to join
                    <br /> our community
                </h1>
            </div>
            <div class="sm:mx-auto sm:w-full sm:max-w-[550px]">
                <div class="bg-white px-10 shadow rounded-b-20 sm:px-5  md:rounded-bl-none md:rounded-r-20">
                    <div class="min-h-full flex flex-col justify-center py-10 sm:px-6 lg:px-8">
                        <div class="sm:mx-auto sm:w-full sm:max-w-md">
                            <img class="mx-auto h-12 w-auto"
                                src="https://tailwindui.com/img/logos/workflow-mark-indigo-600.svg" alt="Workflow" />
                            <h2 class="mt-6 text-center text-3xl font-extrabold text-gray-900">
                                Sign up to your account
                            </h2>
                        </div>
                        <form action="{{ route('register') }}" class="space-y-6 mt-12" method="POST">
                            @csrf
                            <div>
                                <label for="name" class="block text-sm font-medium text-gray-700">
                                    First Name
                                </label>
                                <div class="mt-1">
                                    <input id="name" name="name" type="text" required value="{{ old('name') }}"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                    <x-input-error for="name" />
                                </div>
                            </div>

                            <div>
                                <label for="second_name" class="block text-sm font-medium text-gray-700">
                                    Second Name
                                </label>
                                <div class="mt-1">
                                    <input id="second_name" name="second_name" type="text" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                </div>
                            </div>

                            <div>
                                <label for="email" class="block text-sm font-medium text-gray-700">
                                    Email address
                                </label>
                                <div class="mt-1">
                                    <input id="email" name="email" type="email" required
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
                                        required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                    <x-input-error for="password" />
                                </div>
                            </div>

                            <div>
                                <label for="password_confirmation" class="block text-sm font-medium text-gray-700">
                                    Confirm Password
                                </label>
                                <div class="mt-1">
                                    <input id="password_confirmation" name="password_confirmation" type="password" required
                                        value="{{ old('password_confirmation') }}"
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                    <x-input-error for="password_confirmation" />
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Sign up
                                </button>
                            </div>

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
                                    <a href="{{ route('login.google') }}"
                                        class="text-white bg-[#4285F4] hover:bg-[#4285F4]/90 focus:ring-4 focus:outline-none focus:ring-[#4285F4]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#4285F4]/55 mr-2 mb-2 w-full justify-center md:w-auto">
                                        <span><i class="fa-brands fa-google fa-lg mr-3"></i></span>
                                        Sign up with Google
                                    </a>
                                    <a href="{{ route('login.facebook') }}"
                                        class="text-white bg-[#3b5998] hover:bg-[#3b5998]/90 focus:ring-4 focus:outline-none focus:ring-[#3b5998]/50 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center dark:focus:ring-[#3b5998]/55 mr-2 mb-2 mt-3 w-full justify-center md:w-auto">
                                        <i class="fa-brands fa-facebook-f fa-lg mr-3"></i>
                                        Sign up with Facebook
                                    </a>
                                </div>
                            </div>
                            <p class="text-center mt-7">Have an account? <a href="{{ route('login') }}"
                                    class="text-indigo-600">Login
                                    now</a></p>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
