@extends('layouts.app')

@section('content')
    <div class="container lg:w-[766px] mx-auto mt-16">
        <div class="bg-white rounded-20 shadow-xl p-10">
            <h2 class="text-2xl font-bold">Speakers</h2>
            <div class="flex items-center justify-between mt-10 gap-7 flex-wrap">
                <div class="relative text-gray-600">
                    <input
                        class="border-2 border-gray-300 bg-white h-10 px-10 pr-16 rounded-lg text-sm focus:outline-none w-80"
                        type="search" name="search" placeholder="Search" />
                    <button type="submit" class="absolute left-3 -top-3 mt-5 mr-4">
                        <i class="fa-solid fa-magnifying-glass"></i>
                    </button>
                </div>
                <div class="flex gap-5">
                    <button class="bg-white drop-shadow-filter p-2 rounded-lg flex">
                        <p>Sort by: Date</p>
                        <span><i class="fa-solid fa-chevron-down fa-lg ml-3"></i></span>
                    </button>
                </div>
                <x-input-limits-pagination />
            </div>
            <ul class="mt-10">
                @forelse ($speakers as $speaker)
                    <li class="border-b border-gray-300 py-6">
                        <a href="{{ route('speakers.show', $speaker) }}">
                            <div class="flex justify-between items-center">
                                <div class="flex gap-6">
                                    <img src="{{ $speaker->avatarPath }}" alt="avatar"
                                        class="w-[70px] h-[70px] rounded-full object-cover" />
                                    <div class="">
                                        <p>{{ $speaker->name }}</p>
                                        <p class="text-gray-500">Joined 3 mar 2022</p>
                                    </div>
                                </div>
                                <p class="text-gray-500">appearances: 10</p>
                            </div>
                        </a>
                    </li>
                @empty
                    <p class="text-xl text-center">There are no speakers</p>
                @endforelse
            </ul>
            <div class="py-5">
                {{ $speakers->links('vendor.pagination.tailwind') }}
            </div>
        </div>
    </div>
@endsection
