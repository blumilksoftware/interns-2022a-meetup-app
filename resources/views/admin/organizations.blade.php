@extends('layouts.app')

@section('content')
    <div class="container sm:w-[1216px] mx-auto px-5 xl:px-0">
        <h1>Organizations</h1>
        <div>
            <a href="{{ route('organizations.create') }}">Create new organization</a>
            @if ($organizations->count())
                @foreach ($organizations as $organization)
                    <div>
                        Id: {{ $organization->id }}
                        Name: {{ $organization->name }}
                        Location: {{ $organization->location }}
                        Organization type: {{ $organization->organizationType }}
                        Foundation date: {{ $organization->foundationDate }}
                        Number of employees: {{ $organization->numberOfEmployees }}
                        Created at: {{ $organization->createdAt }}
                        Updated at: {{ $organization->updatedAt }}
                        <div>
                            <a href="{{ route('organizations.edit', $organization) }}">Edit</a>
                            <form action="{{ route('organizations.destroy', $organization) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Delete meetup? This operation is irreversible.')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach

                {{ $organizations->links('vendor.pagination.tailwind') }}
            @else
                <p>There are no organizations</p>
            @endif
        </div>
    </div>
@endsection
