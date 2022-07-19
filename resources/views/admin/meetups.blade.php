@extends('layouts.app')

@section('content')
  <div>
    @include('partials.admin-navbar')
    <div class="md:pl-64 flex flex-col flex-1">
      <main>
        <div class="bg-white rounded-20 m-12 px-10 py-6 shadow-xl">
          <div class="flex justify-between">
            <h3 class="text-2xl font-semibold">Meetups</h3>
            <a href="{{ route('meetups.create') }}"
              class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
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
          <div class="overflow-x-auto">
            <table class="border border-collapse w-full mt-5">
              <thead class="text-left">
                <tr>
                  <th class="border pl-3 py-1">@sortablelink('id')</th>
                  <th class="border pl-3 py-1">@sortablelink('title')</th>
                  <th class="border pl-3 py-1">@sortablelink('date')</th>
                  <th class="border pl-3 py-1">@sortablelink('place')</th>
                  <th class="border pl-3 py-1">@sortablelink('language')</th>
                  <th class="border pl-3 py-1">Actions</th>
                </tr>
              </thead>
              <tbody x-data>
                @foreach ($meetups as $meetup)
                  <tr @click="if($event.target.tagName !== 'BUTTON') window.location.href='{{ route('meetups.show', $meetup) }}'"
                    class="odd:bg-gray-100 cursor-pointer">
                    <td class="border pl-3 py-1">{{ $meetup->id }}</td>
                    <td class="border pl-3 py-1">
                     <p className="">{{ $meetup->title }}</p> </td>
                    <td class="border pl-3 py-1">{{ $meetup->date }}</td>
                    <td class="border pl-3 py-1">{{ $meetup->place }}</td>
                    <td class="border pl-3 py-1">{{ $meetup->language }}</td>
                    <td class="border pl-3 py-1 w-52">
                      <div class="flex gap-3 text-white">
                        <a href="{{ route('meetups.edit', $meetup) }}"
                          class="bg-indigo-600 hover:bg-indigo-700 text-sm px-2 py-0.5 rounded">
                          <i class="fa-solid fa-pen-to-square mr-2"></i>edit
                        </a>
                        <form action="{{ route('meetups.destroy', $meetup) }}" method="post" onsubmit="return confirm('Delete this meetup? This operation is irreversible.')">
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
          <div class="mt-5">
            {{ $meetups->links('vendor.pagination.tailwind') }}
          </div>
        </div>
      </main>
    </div>
  </div>
@endsection
