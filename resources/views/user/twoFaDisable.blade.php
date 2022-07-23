@extends('layouts.app')

@section('content')
    <div class="container lg:w-[933px] mx-auto">
        <div class="md:flex mt-12 px-10 sm:mx-auto sm:w-full sm:max-w-md md:px-0 md:max-w-none">
            </div>
                        <form action="{{ route('disableTwoFa.store') }}" class="space-y-6 mt-12 relative" action="#" method="POST">
                            @csrf
                            @if (!empty($error))
                                <div class="absolute text-red-500 -top-6 left-1/2 transform -translate-x-1/2">
                                    {{ $error }}</div>
                            @endif
                            <div>
                                <label for="code" class="block text-sm font-medium text-gray-700">
                                    Two factor Code
                                </label>
                                <div class="mt-1">
                                    <input id="code" name="code" type="number"
                                        value="{{ old('code') }}" required
                                        class="appearance-none block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" />
                                    <x-input-error for="code" />
                                </div>
                            </div>

                            <div>
                                <button type="submit"
                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                    Disable
                                </button>
                            </div>
                        </form>
        </div>
@endsection
