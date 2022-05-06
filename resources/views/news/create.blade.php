@extends('layouts.app')

@section('content')
  <div class="container md:w-[800px] mx-auto">
    @auth
      <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data"
        class="bg-white p-6 mt-20 rounded-20 shadow-xl" id="createNews">
        @csrf
        <div>
          <div>
            <h3 class="text-xl leading-6 font-medium text-gray-900">
              Create News
            </h3>
          </div>
          <div class="mt-6 flex flex-col gap-7">
            <div x-data class="sm:flex items-center">
              <img x-ref="image" id="image" src="{{ asset('/static/images/no_image.webp') }}" alt="news_avatar"
                class="w-full sm:w-[400px] h-[200px]">
              <input @change="image.src = URL.createObjectURL($event.target.files[0])" type="file" accept="image/*"
                id="logo" name="logo" class="hidden">
              <label for="logo"
                class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer mx-auto w-full justify-center mt-3 sm:w-auto sm:mt-0">
                <i class="fa-solid fa-arrow-up-from-bracket mr-3"></i>
                Upload Image
              </label>
            </div>
            <x-form-input id="title" field="title" label="Title" placeholder="Title" type="text"
              value="{{ old('title') }}" />
              <label for="editor">Content:</label>
              <div class="flex flex-col space-y-2">
                  <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
              </div>
              <x-input-error for="editor"/>
              <input type="hidden" name="text" id="text">
          </div>
        </div>
        <div class="pt-6">
          <div class="flex justify-end">
            <a href="{{ route('news') }}"
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
  <script src="{{ asset('static/js/app.js') }}"></script>
@endsection
