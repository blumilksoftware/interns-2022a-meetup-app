@extends('layouts.app')

@section('content')
    <div class="container sm:w-[1216px] mx-auto px-5 xl:px-0">
        <div>
            <h1>Users</h1>
            @foreach ($users as $user)
                <div>
                    Id: {{ $user->id }}
                    Email: {{ $user->email }}
                    Created at: {{ $user->createdAt }}
                    Updated at: {{ $user->updatedAt }}
                    Role: {{ $user->role->value }}
                </div>
            @endforeach

            {{ $users->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
