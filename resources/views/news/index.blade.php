@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>News</h1>
            @auth
                <a href="{{ route('news.create') }}">Create new news</a>
            @endauth
            @if ($news->count())
                @forelse ($news as $singleNews)
                    <a href="{{ route('news.show', $singleNews) }}" class="w-[397px] h-[309px] rounded-2xl bg-white shadow-lg">
                        <div>
                            {{ $singleNews->title }}
                            {!! Str::markdown($singleNews->text) !!}
                            {{ $singleNews->author }}

                            <a href="{{ route('news.edit', $singleNews) }}">Edit</a>
                            <form action="{{ route('news.destroy', $singleNews) }}">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Delete News? This operation is irreversible.')">Delete
                                </button>
                            </form>
                        </div>
                    </a>
                @empty
                    <p>There are no news</p>
                @endforelse
            @endif
        </div>
    </div>
@endsection
