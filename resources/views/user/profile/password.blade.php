@extends('layouts.app')

@section('content')
    <div class="container md:w-[800px] mx-auto">
        @auth
            <form method="post" action="" enctype="multipart/form-data"
                  class="bg-white p-6 mt-20 rounded-20 shadow-xl">
                @method('PUT')
                @csrf
                <div>
                    <div>
                        @if (!empty($error))
                            <div class="relative text-red-500 -top-6 left-1/2 transform -translate-x-1/2">
                                {{ $error }}</div>
                        @endif
                        <h3 class="text-xl leading-6 font-medium text-gray-900">
                            Edit Profile
                        </h3>
                    </div>
                        <div>
                            <div>
                                <label for="password" class="block text-sm font-medium text-gray-700">
                                    Current Password
                                </label>
                                <div class="mt-1">
                                    <input id="password" name="password" type="password" value="{{ old('password') }}"
                                           required
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                    <x-input-error for="password" />
                                </div>
                            </div>
                            <div>
                                <label for="newPassword" class="block text-sm font-medium text-gray-700">
                                    New Password
                                </label>
                                <div class="mt-1">
                                    <input id="newPassword" name="newPassword" type="password" value="{{ old('newPassword') }}"
                                           required
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                    <x-input-error for="newPassword" />
                                </div>
                            </div>

                            <div>
                                <label for="newPassword_confirmation" class="block text-sm font-medium text-gray-700">
                                    Confirm New Password
                                </label>
                                <div class="mt-1">
                                    <input id="newPassword_confirmation" name="newPassword_confirmation" type="password" required
                                           value="{{ old('newPassword_confirmation') }}"
                                           class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                    <x-input-error for="newPassword_confirmation" />
                                </div>
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
