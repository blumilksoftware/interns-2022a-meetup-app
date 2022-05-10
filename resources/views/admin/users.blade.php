@extends('layouts.app')

@section('content')
  <div class="flex justify-end relative">
    @include('partials.admin-navbar')
    <div class="bg-white w-[1432px] rounded-20 m-12 px-10 py-6">
      <h3 class="text-2xl font-semibold">Users</h3>
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
            <th class="border pl-3">Id</th>
            <th class="border pl-3">Email address</th>
            <th class="border pl-3">Created at</th>
            <th class="border pl-3">Updated at</th>
            <th class="border pl-3">Actions</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($users as $user)
            <tr class="bg-gray-100">
              <td class="border pl-3 py-1">{{ $user->id }}</td>
              <td class="border pl-3">{{ $user->email }}</td>
              <td class="border pl-3">{{ $user->createdAt }}</td>
              <td class="border pl-3">{{ $user->updatedAt }}</td>
              <td class="border pl-3 w-52">
                <form action="{{ route('users.destroy', $user) }}" method="post">
                  @csrf
                  @method('delete')
                  <button href="#" class="bg-red-500 hover:bg-red-600 text-sm px-2 py-0.5 rounded text-white">
                    <i class="fa-solid fa-trash-can mr-2"></i>delete
                  </button>
                </form>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
@endsection
