@extends('layouts.app')

@section('content')
    <div class="container sm:w-[1216px] mx-auto px-5 xl:px-0">
        <h1>News</h1>
        <div>
            <a href="{{ route('news.create') }}">Create new news</a>
            @forelse ($news as $singleNews)
                <div>
                    {{ $singleNews->title }}
                    {!! Str::markdown($singleNews->text) !!}
                    {{ $singleNews->author }}
                    <div>
                        <a href="{{ route('news.edit', $singleNews) }}">Edit</a>
                        <form action="{{ route('news.destroy', $singleNews) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit"
                                    onclick="return confirm('Delete News? This operation is irreversible.')">
                                Delete
                            </button>
                        </form>
                    </div>
                </div>
            @empty
                <p>There are no news</p>
            @endforelse
        </div>
        {{ $news->links('vendor.pagination.tailwind') }}
    </div>
@endsection
