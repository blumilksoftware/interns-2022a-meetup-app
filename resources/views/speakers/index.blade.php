@extends('layouts.app')

@section('content')
    <div class="container lg:w-[766px] mx-auto mt-16" x-data="{ sortDropdownOpened: false }">
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
                <div class="gap-5 relative">
                    <div>
                        <button @click="sortDropdownOpened = !sortDropdownOpened"
                                class="bg-white drop-shadow-filter p-2 rounded-lg flex">
                            <p>Sort by:
                                @sortablelink(Request::get("sort"), str_replace("_"," ", Request::get("sort")))
                            </p>
                            <span><i class="fa-solid fa-chevron-down fa-lg ml-3"></i></span>
                        </button>
                    </div>
                    <div x-show="sortDropdownOpened" x-cloak x-transition
                         class="origin-top-right absolute right-0 mt-2 w-auto rounded-md shadow-lg py-1 bg-white ring-1 ring-black ring-opacity-5 focus:outline-none z-10"
                         id="speakers-sort-menu" role="menu" aria-orientation="vertical" aria-labelledby="speakers-sort-menu-button"
                         tabindex="-1">
                         <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                               role="menuitem" tabindex="-1" id="sort-menu-item-0">
                                @sortablelink('name')
                         </span>
                        <span class="block px-4 py-2 text-sm text-gray-700 hover:bg-indigo-600 hover:text-white"
                              role="menuitem" tabindex="-1" id="sort-menu-item-1">
                                @sortablelink('meetups_count', 'Meetups count')
                        </span>
                    </div>
                </div>
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
                                        <p class="text-gray-500">Joined {{ $speaker->createdAt->diffForHumans() }}</p>
                                    </div>
                                </div>
                                <p class="text-gray-500">Appearances: {{ $speaker->meetups_count }}</p>
                            </div>
                        </a>
                    </li>
                @empty
                    <p class="text-xl text-center absolute top-4">There are no speakers</p>
                @endforelse
            </ul>
            <div class="py-5">
                {{ $speakers->appends(Request::except('page'))->render() }}
            </div>
        </div>
    </div>
@endsection
