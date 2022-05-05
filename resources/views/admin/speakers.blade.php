@extends('layouts.app')

@section('content')
    <div class="container sm:w-[1216px] mx-auto px-5 xl:px-0">
        <h1>Speakers</h1>
        <div>
            <a href="{{ route('speakers.create') }}">Create new speaker</a>
            @if ($speakers->count())
                @foreach ($speakers as $speaker)
                    <div>
                        Id: {{ $speaker->id }}
                        Name: {{ $speaker->name }}
                        Description: {{ $speaker->description }}
                        Linkedin: {{ $speaker->linkedinUrl }}
                        GitHub: {{ $speaker->githubUrl }}
                        Created at: {{ $speaker->createdAt }}
                        Updated at: {{ $speaker->updatedAt }}
                        <div>
                            <a href="{{ route('organizations.edit', $speaker) }}">Edit</a>
                            <form action="{{ route('organizations.destroy', $speaker) }}" method="post">
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

                {{ $speakers->links('vendor.pagination.tailwind') }}
            @else
                <p>There are no speakers</p>
            @endif
        </div>
    </div>
@endsection
