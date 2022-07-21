@extends('layouts.app')

@section('content')
  <div>
    @include('partials.admin-navbar')
    <div class="md:pl-64 flex flex-col flex-1">
      <main>
        <div class="bg-white rounded-20 m-12 px-10 py-6 shadow-xl">
          <div class="flex justify-between">
            <h3 class="text-2xl font-semibold">Speakers</h3>
            <a href="{{ route('speakers.create') }}"
              class="bg-green-600 text-white px-5 py-2 rounded-lg hover:bg-green-700">
              Add speaker
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
                  <th class="border pl-3 py-1">@sortablelink('name')</th>
                  <th class="border pl-3 py-1">@sortablelink('linkedin_url', 'Linkedin')</th>
                  <th class="border pl-3 py-1">@sortablelink('github_url', 'GitHub')</th>
                  <th class="border pl-3 py-1">@sortablelink('created_at', 'Created at')</th>
                  <th class="border pl-3 py-1">@sortablelink('updated_at', 'Updated at')</th>
                  <th class="border pl-3 py-1">Actions</th>
                </tr>
              </thead>
              <tbody x-data>
                @foreach ($speakers as $speaker)
                  <tr
                    @click="if($event.target.tagName !== 'BUTTON') window.location.href='{{ route('speakers.show', $speaker) }}'"
                    class=" 
                    odd:bg-gray-100 cursor-pointer">
                    <td class="border pl-3 py-1">{{ $speaker->id }}</td>
                    <td class="border pl-3 py-1">{{ $speaker->name }}</td>
                    <td class="border pl-3 py-1">{{ $speaker->linkedinUrl }}</td>
                    <td class="border pl-3 py-1">{{ $speaker->githubUrl }}</td>
                    <td class="border pl-3 py-1">{{ $speaker->createdAt }}</td>
                    <td class="border pl-3 py-1">{{ $speaker->updatedAt }}</td>
                    <td class="border pl-3 py-1 w-52">
                      <div class="flex gap-3 text-white">
                        <a href="{{ route('speakers.edit', $speaker) }}"
                          class="bg-indigo-600 hover:bg-indigo-700 text-sm px-2 py-0.5 rounded">
                          <i class="fa-solid fa-pen-to-square mr-2"></i>edit
                        </a>
                        <form action="{{ route('speakers.destroy', $speaker) }}" method="post"
                          onsubmit="return confirm('Delete this speaker? This operation is irreversible.')">
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
            {{ $speakers->links('vendor.pagination.tailwind') }}
          </div>
        </div>
      </main>
    </div>
  </div>
@endsection
