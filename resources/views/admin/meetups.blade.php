@extends('layouts.app')

@section('content')
  <div class="flex justify-end relative">
    @include('partials.admin-navbar')
    <div class="bg-white w-[1432px] rounded-20 m-12 px-10 py-6">
      <div class="flex justify-between">
        <h3 class="text-2xl font-semibold">Meetups</h3>
        <a href="{{ route('meetups.create') }}" class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
          Add meetup
        </a>
      </div>
      <div class="relative text-gray-600 mt-5">
        <input class="border-2 border-gray-300 bg-white h-10 px-10 pr-16 rounded-lg text-sm focus:outline-none w-80"
          type="search" name="search" placeholder="Search" />
        <button type="submit" class="absolute left-3 -top-3 mt-5 mr-4">
          <i class="fa-solid fa-magnifying-glass"></i>
        </button>
      </div>
      <table class="border border-collapse w-full mt-5">
        <thead class="text-left">
          <tr>
            <th class="border pl-3 py-1">Id</th>
            <th class="border pl-3 py-1">Description</th>
            <th class="border pl-3 py-1">Date</th>
            <th class="border pl-3 py-1">Place</th>
            <th class="border pl-3 py-1">Language</th>
            <th class="border pl-3 py-1">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($meetups as $meetup)
            <tr class="odd:bg-gray-100">
              <td class="border pl-3 py-1">{{ $meetup->id }}</td>
              <td class="border pl-3 py-1 truncate">{{ $meetup->description }}</td>
              <td class="border pl-3 py-1">{{ $meetup->date }}</td>
              <td class="border pl-3 py-1">{{ $meetup->place }}</td>
              <td class="border pl-3 py-1">{{ $meetup->language }}</td>
              <td class="border pl-3 py-1 w-52">
                <div class="flex gap-3 text-white">
                  <a href="{{ route('meetups.edit', $meetup) }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-sm px-2 py-0.5 rounded">
                    <i class="fa-solid fa-pen-to-square mr-2"></i>edit
                  </a>
                  <form action="{{ route('meetups.destroy', $meetup) }}" method="post">
                    @csrf
                    @method('delete')
                    <button class="bg-red-500 hover:bg-red-600 text-sm px-2 py-0.5 rounded text-white">
                      <i class="fa-solid fa-trash-can mr-2"></i>delete
                    </button>
                  </form>
                </div>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
