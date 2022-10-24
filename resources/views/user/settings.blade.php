@extends('layouts.app')

@section('content')
    <div class="container lg:w-[933px] mx-auto">
        <div class="md:flex mt-12 px-10 sm:mx-auto sm:w-full sm:max-w-md md:px-0 md:max-w-none">
            </div>
                            @csrf
                            @if (!empty($error))
                                <div class="absolute text-red-500 -top-6 left-1/2 transform -translate-x-1/2">
                                    {{ $error }}
                                </div>
                            @endif
                            <div>
                                @if($twoFactor)
                                    <div>
                                        <label for="code" class="block text-sm font-medium text-gray-700">
                                            Two factor is enabled
                                        </label>
                                        <form action="{{ route('disableTwoFa') }}" class="space-y-6 mt-12 relative" action="#" method="POST">
                                            @csrf
                                            <button value="Disable" type="submit"
                                                    class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Disable
                                            </button>
                                        </form>
                                    </div>
                                @elseif(!($twoFactor))
                                    <div>
                                        <label for="code" class="block text-sm font-medium text-gray-700">
                                            Two factor is disabled
                                        </label>
                                        <form action="{{ route('enableTwoFa') }}" class="space-y-6 mt-12 relative" action="#" method="POST">
                                            @csrf
                                            <button value="Enable" type="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Enable
                                            </button>
                                        </form>
                                    </div>
                                @endif
                            </div>
        </div>
@endsection
