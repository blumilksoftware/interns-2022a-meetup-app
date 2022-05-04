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
                        <h3 class="text-xl leading-6 font-medium text-gray-900">
                            Edit Profile
                        </h3>
                    </div>
                    <div class="mt-6 flex flex-col gap-7">
                        <x-form-input id="name" field="name" label="Name" placeholder="Name" type="text"
                                      value="{{ old('name', $user->name) }}" />
                    </div>
                        <div>
                            <label for="avatar" class="block font-medium text-gray-700">
                                Avatar
                            </label>
                            <div x-data class="flex items-center gap-12 mt-4">
                                <img x-ref="image" id="image" src="{{ $user->avatarPath }}" alt="{{ $user->name }} avatar"
                                     class="w-full sm:w-[100px] h-[100px] rounded-full object-cover">
                                <input @change="image.src = URL.createObjectURL($event.target.files[0])" type="file" accept="image/*"
                                       id="avatar" name="avatar" class="hidden">
                                <label for="avatar"
                                       class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer w-full justify-center mt-3 sm:w-auto sm:mt-0">
                                    <i class="fa-solid fa-arrow-up-from-bracket mr-3"></i>
                                    Upload Image
                                </label>
                                <x-input-error for="avatar" />
                            </div>
                            <x-form-input id="email" field="email" label="email" placeholder="email" type="email"
                                          value="{{ old('email', $user->email) }}" />
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
                        <a href="{{ route('speakers') }}"
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