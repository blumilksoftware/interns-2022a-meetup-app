@extends('layouts.app')

@section('content')
    <div class="container md:w-[800px] mx-auto">
        @auth
            <form method="post" action="{{ route('organizations.profiles.update', [$organization, $profile]) }}"
                enctype="multipart/form-data" class="bg-white p-6 mt-20 rounded-20 shadow-xl">
                @method('PUT')
                @csrf
                <div>
                    <div>
                        <h3 class="text-xl leading-6 font-medium text-gray-900">
                            Edit Profile
                        </h3>
                    </div>
                    <div class="mt-6 flex flex-col gap-7">
                        <div>
                            <label for="label" class="block font-medium text-gray-700">
                                Name
                            </label>
                            <div class="mt-1">
                                <select name="label" id="label"
                                    class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md">
                                    @foreach ($availableProfiles as $availableProfile)
                                        <option value="{{ $availableProfile['label'] }}"
                                            @if ($availableProfile['label'] === old('label', $profile->label)) selected @endif>
                                            {{ $availableProfile['label'] }}
                                        </option>
                                    @endforeach
                                </select>
                                <x-input-error for="label" />
                            </div>
                        </div>
                        <x-form-input id="link" name="Link" type="text" value="{{ old('link', $profile->link) }}" />
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
        @endauth
    </div>
@endsection
