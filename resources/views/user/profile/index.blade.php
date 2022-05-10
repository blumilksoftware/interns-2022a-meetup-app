@extends('layouts.app')

@section('content')
    <div class="container lg:w-[1141px] mx-auto">
        <div class="md:flex mt-8 px-10 sm:mx-auto sm:w-full sm:max-w-md md:px-0 md:max-w-none">
            <div>
                <h1>
                    User Profile
                </h1>
                <div>
                    @csrf
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            Avatar
                        </label>
                        <div class="mt-1">
                            <img src="{{ $user->avatarPath }}" alt="avatar"
                            class="w-[200px] h-[200px] rounded-t-20 object-cover"/>
                        </div>
                    </div>
                    <div>
                        <label for="name" class="block text-sm font-medium text-gray-700">
                            UserName
                        </label>
                        <div class="mt-1">
                            <input id="name" name="name" readonly type="text" value="{{ $user->name }}"
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                    </div>

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">
                            Email address
                        </label>
                        <div class="mt-1">
                            <input id="email" name="email" readonly type="email" value="{{ $user->email }}"
                                   class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                        </div>
                    </div>
                    <div>
                        <a href="{{ route("user.profile.edit") }}">
                        <button type="submit"
                                class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Edit profile
                        </button></a>
                        <a href="{{ route("user.profile.password") }}">
                            <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Change password
                            </button></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
