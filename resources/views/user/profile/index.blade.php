@extends('layouts.app')

@section('content')
  <div class="container lg:w-[800px] mx-auto shadow-xl">
    <div class="bg-white mt-20 px-8 md:px-12 lg:px-16 py-8 rounded-2xl">
      <div class="flex justify-between items-center">
        <h3 class="text-xl font-semibold">General</h3>
        <div>
          <a href="{{ route('user.profile.edit') }}"
            class="text-sm text-white py-2 px-3 rounded-xl bg-indigo-600 hover:bg-indigo-700">
            Edit Profile
          </a>
        </div>
      </div>
      <div class="flex flex-col md:flex-row justify-around items-center border-y-2 py-3 mt-3">
        <div class="w-1/2">
          <img src="{{ $user->avatarPath }}" alt="avatar" class="w-52 h-52 rounded-full object-cover mx-auto" />
        </div>
        <div class="md:w-1/2">
          <div class="flex gap-5 py-3 border-b-2">
            <p class="font-semibold">Name:</p>
            <p>{{ $user->name }}</p>
          </div>
          <div class="flex gap-5 py-3 border-b-2">
            <p class="font-semibold">Email address:</p>
            <p>{{ $user->email }}</p>
          </div>
          <div class="flex gap-5 py-3 border-b-2">
            <p class="font-semibold">Location:</p>
            <p>{{ $user->location }}</p>
          </div>
          <div class="flex gap-5 py-3 border-b-2">
            <p class="font-semibold">Birthday:</p>
            <p>{{ $user->birthday->toDateString() }}</p>
          </div>
          <div class="flex gap-5 py-3">
            <p class="font-semibold">Gender:</p>
            <p>{{ $user->gender }}</p>
          </div>
        </div>
      </div>
      <div class="mt-5 -mb-5">
        <a href="{{ route('user.profile.password') }}"
          class="text-sm text-white py-2 px-3 rounded-xl bg-indigo-600 hover:bg-indigo-700">
          Change password
        </a>
      </div>
      <h3 class="text-xl font-semibold mt-10 pb-3 border-b-2">Interests</h3>
      <form action="#" method="post">
        <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-x-20 gap-y-5 py-5 whitespace-nowrap">
          <div class="flex items-center gap-4">
            <input type="checkbox" class="text-indigo-600 rounded" />
            <p>Agile Project management</p>
          </div>
          <div class="flex items-center gap-4">
            <input type="checkbox" class="text-indigo-600 rounded" />
            <p>Javascript</p>
          </div>
          <div class="flex items-center gap-4">
            <input type="checkbox" class="text-indigo-600 rounded" />
            <p>Web technology</p>
          </div>
          <div class="flex items-center gap-4">
            <input type="checkbox" class="text-indigo-600 rounded" />
            <p>Javascript</p>
          </div>
          <div class="flex items-center gap-4">
            <input type="checkbox" class="text-indigo-600 rounded" />
            <p>Web development</p>
          </div>
          <div class="flex items-center gap-4">
            <input type="checkbox" class="text-indigo-600 rounded" />
            <p>Web design</p>
          </div>
        </div>
        <button class="text-sm text-white py-2 px-4 rounded-xl bg-indigo-600 hover:bg-indigo-700">
          Save
        </button>
      </form>
    </div>
  </div>
@endsection
