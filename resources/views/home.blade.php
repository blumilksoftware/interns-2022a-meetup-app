@extends('layouts.app')

@section('content')
    <div>
        <div class="relative">
            <div class="absolute inset-x-0 bottom-0 h-1/2 bg-gray-100"></div>
            <div class="max-w-7x mx-auto ">
                <div class="relative shadow-xl sm:overflow-hidden">
                    <div class="absolute inset-0">
                        <img class="h-full w-full object-cover" src={{ asset('static/images/hero.webp') }}
                            alt="People working on laptops" />
                        <div class="absolute inset-0 bg-indigo-400 mix-blend-multiply"></div>
                    </div>
                    <div class="relative px-4 py-16 sm:px-6 sm:py-24 lg:py-32 lg:px-8">
                        <h1 class="text-center text-4xl font-extrabold tracking-normal sm:text-5xl lg:text-6xl">
                            <span class="block text-white">Find your favorite event</span>
                            <span class="block text-indigo-200 mt-5">
                                Meet new people
                            </span>
                            <span class="block text-white mt-5">Learn something new</span>
                        </h1>
                        <p class="mt-6 max-w-lg mx-auto text-center text-xl text-indigo-200 sm:max-w-3xl">
                            Anim aute id magna aliqua ad ad non deserunt sunt. Qui irure
                            qui lorem cupidatat commodo. Elit sunt amet fugiat veniam
                            occaecat fugiat aliqua.
                        </p>
                        <div class="mt-10 max-w-sm mx-auto sm:max-w-none sm:flex sm:justify-center">
                            <div class="text-center">
                                <a href="{{ route('register') }}"
                                    class="flex items-center justify-center px-4 py-3 border border-transparent text-base font-medium rounded-md shadow-sm text-indigo-700 bg-white hover:bg-indigo-50 sm:px-8">
                                    Get started
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container xl:w-[1280px] mx-auto px-8 md:px-0">
        <div class="flex flex-col items-center">
            <h1 class="mt-10 text-4xl">Explore</h1>
            <div class="pt-2 mt-5 relative text-gray-600">
                <input class="border-2 border-gray-300 bg-white h-10 px-10 pr-16 rounded-lg text-sm focus:outline-none w-96"
                    type="search" name="search" placeholder="Search" />
                <button type="submit" class="absolute left-3 -top-1 mt-5 mr-4">
                    <i class="fa-solid fa-magnifying-glass"></i>
                </button>
            </div>
        </div>
        <div class="flex flex-wrap gap-8 mt-12">
            <button class="bg-white drop-shadow-filter p-2 rounded-lg flex">
                <p>Any category</p>
                <span><i class="fa-solid fa-chevron-down fa-lg ml-3"></i></span>
            </button>
            <button class="bg-white drop-shadow-filter p-2 rounded-lg flex">
                <p>Any day</p>
                <span><i class="fa-solid fa-chevron-down fa-lg ml-3"></i></span>
            </button>
            <button class="bg-white drop-shadow-filter p-2 rounded-lg flex">
                <p>Any type</p>
                <span><i class="fa-solid fa-chevron-down fa-lg ml-3"></i></span>
            </button>
            <button class="bg-white drop-shadow-filter p-2 rounded-lg flex">
                <p>Any language</p>
                <span><i class="fa-solid fa-chevron-down fa-lg ml-3"></i></span>
            </button>
            <button class="bg-white drop-shadow-filter p-2 rounded-lg flex">
                <p>Any Sort by: Date</p>
                <span><i class="fa-solid fa-chevron-down fa-lg ml-3"></i></span>
            </button>
        </div>
        <div class="grid place-items-center md:grid-cols-2 xl:grid-cols-3 gap-y-12 gap-x-10 mt-8 relative">
            @forelse ($meetups as $meetup)
                <a href="#" class="w-[397px] h-[309px] rounded-2xl bg-white shadow-lg">
                    <img src="{{ $meetup->logoPath }}" alt="{{ $meetup->title }} logo"
                        class="w-[397px] h-[167px] rounded-t-20" />
                    <div class="flex justify-between px-7 mt-1">
                        <div class="flex flex-col h-[100px] justify-around">
                            <p class="text-xl">{{ $meetup->title }}</p>
                            <p class="text-sm text-gray-500">
                                <i class="fa-regular fa-clock fa-lg mr-2"></i>
                                {{ $meetup->date }}
                            </p>
                            <p class="text-sm text-gray-500">
                                <i class="fa-solid fa-location-dot fa-xl mr-2"></i>
                                {{ $meetup->place }}
                            </p>
                        </div>
                        <div class="text-xl text-center mt-1">
                            <p class="text-red-500">Feb</p>
                            <p>24</p>
                        </div>
                    </div>
                </a>
            @empty
                <p class="text-xl text-center absolute top-4">There are no meetups</p>
            @endforelse
        </div>
        <div class="mt-10">
            {{ $meetups->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
