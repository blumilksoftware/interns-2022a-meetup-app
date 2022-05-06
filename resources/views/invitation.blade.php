@extends('layouts.app')

@section('content')
    <div class="container md:w-[800px] mx-auto">
        @auth
            <form action="{{ route('invitation.store') }}" method="post" enctype="multipart/form-data"
                  class="bg-white p-6 mt-20 rounded-20 shadow-xl">
                @csrf
                <div>
                    @if(session()->has('message'))
                        <div>
                            {{ session()->get('message') }}
                        </div>
                    @endif
                    <div>
                        <h3 class="text-xl leading-6 font-medium text-gray-900">
                            Invite User
                        </h3>
                    </div>
                    <div class="mt-6 flex flex-col gap-7">
                        <div>
                            <label for="email" class="block font-medium text-gray-700">
                                Email
                            </label>
                            <div class="mt-1">
                                <input type="email" name="email" id="email" placeholder="Email" value="{{ old('email') }}"
                                       class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md" />
                                <x-input-error for="email" />
                            </div>
                        </div>
                    </div>
                </div>
                <div class="pt-6">
                    <div class="flex justify-end">
                        <a href="{{ route("meetups") }}"
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
