@extends('layouts.app')

@section('content')
    <div class="container md:w-[800px] mx-auto">
        @auth
            <form action="{{ route('meetups.store') }}" method="post" class="bg-white p-6 mt-20 rounded-20 shadow-xl">
                @csrf
                <div>
                    <div>
                        <h3 class="text-xl leading-6 font-medium text-gray-900">
                            Create Meetup
                        </h3>
                    </div>
                    <div class="mt-6 flex flex-col gap-5">
                        <div>
                            <label for="title" class="block text-sm font-medium text-gray-700">
                                Title
                            </label>
                            <div class="mt-1">
                                <input type="text" name="title" id="title" placeholder="Title..." value="{{ old('title') }}"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                <x-input-error for="title" />
                            </div>
                        </div>

                        <div>
                            <label for="description" class="block text-sm font-medium text-gray-700">
                                Description
                            </label>
                            <div class="mt-1">
                                <textarea rows="5" type="text" name="description" id="description" placeholder="Description..."
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                                <x-input-error for="description" />
                            </div>
                        </div>

                        <div>
                            <label for="date" class="block text-sm font-medium text-gray-700">
                                Date
                            </label>
                            <div class="mt-1">
                                <input type="date" name="date" id="date" placeholder="Date..." value="{{ old('date') }}"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                <x-input-error for="date" />
                            </div>
                        </div>

                        <div>
                            <label for="place" class="block text-sm font-medium text-gray-700">
                                Place
                            </label>
                            <div class="mt-1">
                                <input type="text" name="place" id="place" placeholder="Place..." value="{{ old('place') }}"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                <x-input-error for="place" />
                            </div>
                        </div>

                        <div>
                            <label for="language" class="block text-sm font-medium text-gray-700">
                                Language
                            </label>
                            <div class="mt-1">
                                <input type="text" name="language" id="language" placeholder="Language..."
                                    value="{{ old('language') }}"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                <x-input-error for="language" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-6">
                    <div class="flex justify-end">
                        <a href="/"
                            class="bg-white py-2 px-4 border border-gray-300 rounded-md shadow-sm text-sm font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Cancel
                        </a>
                        <button type="submit"
                            class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Save
                        </button>
                    </div>
                </div>
            </form>
        @endauth
    </div>
@endsection
