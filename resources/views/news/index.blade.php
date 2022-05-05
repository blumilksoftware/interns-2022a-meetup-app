@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>News</h1>
            @auth
                <a href="{{ route('news.create') }}">Create new news</a>
            @endauth
            @if ($news->count())
                @foreach ($news as $singleNews)
                    <div>
                        {{ $singleNews->title }}
                        {!! Str::markdown($singleNews->text) !!}
                        {{ $singleNews->author }}

                        <a href="{{ route('news.edit', $singleNews) }}">Edit</a>
                        <form action="{{ route('news.destroy', $singleNews) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"  onclick="return confirm('Delete News? This operation is irreversible.')">Delete</button>
                        </form>
                    </div>
                @endforeach
            @else
                <p>There are no news</p>
            @endif
        </div>
    </div>
@endsection
