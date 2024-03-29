@extends('layouts.app')

@section('content')
  <div class="container md:w-[800px] mx-auto">
    @auth
      <div class="bg-white p-6 mt-20 rounded-20 shadow-xl">
        <form action="{{ route('organizations.update', $organization) }}" method="post" enctype="multipart/form-data">
          @method('PUT')
          @csrf
          <div>
            <div>
              <h3 class="text-xl leading-6 font-medium text-gray-900">
                Edit Organization
              </h3>
            </div>
            <div class="mt-6 flex flex-col gap-7">
              <div x-data class="sm:flex items-center">
                <img x-ref="image" id="image" src="{{ $organization->logoPath }}" alt="{{ $organization->name }} logo"
                  class="w-full sm:w-[400px] h-[200px]">
                <input @change="image.src = URL.createObjectURL($event.target.files[0])" type="file" accept="image/*"
                  id="logo" name="logo" class="hidden">
                <label for="logo"
                  class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-base font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 cursor-pointer mx-auto w-full justify-center mt-3 sm:w-auto sm:mt-0">
                  <i class="fa-solid fa-arrow-up-from-bracket mr-3"></i>
                  Upload Image
                </label>
              </div>
              <x-form-input id="name" field="name" label="Name" placeholder="Name" type="text"
                value="{{ old('name', $organization->name) }}" />
              <div>
                <label for="description" class="block font-medium text-gray-700">
                  Description
                </label>
                <div class="mt-1">
                  <textarea rows="5" name="description" id="description" placeholder="Description"
                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">{{ old('description', $organization->description) }}</textarea>
                  <x-input-error for="description" />
                </div>
              </div>
              <x-form-input id="location" field="location" label="Location" placeholder="Location" type="text"
                value="{{ old('location', $organization->location) }}" />
              <x-form-input id="organization_type" field="organization_type" label="Organization type"
                placeholder="Organization type" type="text"
                value="{{ old('organization_type', $organization->organizationType) }}" />
              <x-form-input id="foundation_date" field="foundation_date" label="Foundation date"
                placeholder="Foundation date" type="datetime-local"
                value="{{ old('foundation_date', $organization->foundationDate) }}" />
              <x-form-input id="number_of_employees" field="number_of_employees" label="Number of employees"
                placeholder="Number of employees" type="number"
                value="{{ old('number_of_employees', $organization->numberOfEmployees) }}" />
              <x-form-input id="website_url" field="website_url" label="Website" placeholder="Website url" type="text"
                value="{{ old('website_url', $organization->websiteUrl) }}" />
            </div>
          </div>
          <div class="pt-6">
            <div class="flex justify-end">
              <a href="{{ route('organizations') }}"
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
        <div class="flex justify-between items-center mt-12 mb-8">
          <h3 class="text-xl font-medium text-gray-900 ">Organization profiles</h3>
          <a href="{{ route('organizations.profiles.create', $organization) }}"
            class="inline-flex py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-green-500">Add
            profile</a>
        </div>
        @forelse ($organization->organizationProfiles as $profile)
          <div class="flex items-end justify-between mt-5">
            <div>
              <p> <i class="{{ $profile->getIconPath() }} text-gray-600 text-lg mr-2 rounded-full"></i>
                {{ $profile->label }}:</p>
              <a href="{{ $profile->link }}" class="text-blue-500 hover:text-blue-600"
                target="_blank">{{ $profile->link }}</a>
            </div>
            <div class="flex">
              <a href="{{ route('organizations.profiles.edit', [$organization, $profile]) }}"
                class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Edit</a>
              <form action="{{ route('organizations.profiles.destroy', [$organization, $profile]) }}" method="post">
                @csrf
                @method('DELETE')
                <button type="submit" onclick="return confirm('Sure Want Delete?')"
                  class="ml-3 inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-red-600 hover:bg-red-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-red-500">Delete</button>
              </form>
            </div>
          </div>
        @empty
          <p>There are no organization profiles</p>
        @endforelse
      </div>
    @endauth
  </div>
@endsection
