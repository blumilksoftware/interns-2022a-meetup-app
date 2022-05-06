@extends('layouts.app')

@section('content')
    <div class="container sm:w-[1216px] mx-auto px-5 xl:px-0">
        <h1>Users</h1>
        <div>
            @foreach ($users as $user)
                <div>
                    Id: {{ $user->id }}
                    Email: {{ $user->email }}
                    Created at: {{ $user->createdAt }}
                    Updated at: {{ $user->updatedAt }}
                </div>
                <div>
                    <form action="{{ route('users.destroy', $user) }}" method="post">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                onclick="return confirm('Delete user? This operation is irreversible.')">
                            Delete
                        </button>
                    </form>
                </div>
            @endforeach

            {{ $users->links('vendor.pagination.tailwind') }}
        </div>
    </div>
@endsection
