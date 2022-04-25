@extends('layouts.app')

@section('content')
  <div class="container md:w-[800px] mx-auto">
    @auth
      <form action="{{ route('meetups.store') }}" method="post" enctype="multipart/form-data"
        class="bg-white p-6 mt-20 rounded-20 shadow-xl">
        @csrf
        <div>
          <div>
            <h3 class="text-xl leading-6 font-medium text-gray-900">
              Create Meetup
            </h3>
          </div>
          <div class="mt-6 flex flex-col gap-7">
            <div x-data class="sm:flex items-center">
              <img x-ref="image" id="image" src="{{ asset('/static/images/no_image.webp') }}" alt="meetup_avatar"
                class="w-full sm:w-[400px] h-[200px]">
              <input @change="image.src = URL.createObjectURL($event.target.files[0])" type="file" accept="image/*"
                id="logo" name="logo" class="hidden">
              <label for="logo"
                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer mx-auto w-full justify-center mt-3 sm:w-auto sm:mt-0">
                <i class="fa-solid fa-arrow-up-from-bracket mr-3"></i>
                Upload Image
              </label>
            </div>
            <x-form-input id="title" field="title" label="Title" placeholder="Title..." type="text"
              value="{{ old('title') }}" />
            <div>
              <label for="description" class="block font-medium text-gray-700">
                Description
              </label>
              <div class="mt-1">
                <textarea rows="5" type="text" name="description" id="description" placeholder="Description..."
                  class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description') }}</textarea>
                <x-input-error for="description" />
              </div>
            </div>
            <x-form-input id="date" field="date" label="Date" placeholder="Date..." type="datetime-local"
              value="{{ old('date') }}" />
            <x-form-input id="place" field="place" label="Place" placeholder="Place..." type="text"
              value="{{ old('place') }}" />
            <x-form-input id="language" field="language" label="Language" placeholder="Language..." type="text"
              value="{{ old('language') }}" />
          </div>
        </div>
        <div class="pt-6">
          <div class="flex justify-end">
            <a href="{{ route('meetups') }}"
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
