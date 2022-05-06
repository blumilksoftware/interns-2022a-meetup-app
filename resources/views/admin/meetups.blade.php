@extends('layouts.app')

@section('content')
    <div class="container sm:w-[1216px] mx-auto px-5 xl:px-0">
        <h1>Meetups</h1>
        <div>
            <a href="{{ route('meetups.create') }}">Create new meetup</a>
            @if ($meetups->count())
                @forelse ($meetups as $meetup)
                    <div>
                        Title: {{ $meetup->title }}
                        Description: {{ $meetup->description }}
                        Date: {{ $meetup->date }}
                        Place: {{ $meetup->place }}
                        Language: {{ $meetup->language }}
                        <div>
                            <a href="{{ route('meetups.edit', $meetup) }}">Edit</a>
                            <form action="{{ route('meetups.destroy', $meetup) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                        onclick="return confirm('Delete meetup? This operation is irreversible.')">
                                    Delete
                                </button>
                            </form>
                        </div>
                    </div>
                @empty
                    <p>There are no meetups</p>
                @endforelse

                {{ $meetups->links('vendor.pagination.tailwind') }}
            @endif
        </div>
    </div>
@endsection
