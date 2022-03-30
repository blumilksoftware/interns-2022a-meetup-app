@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>News</h1>
            @auth
                <a href="{{ route('news.create') }}">Create new news</a>
            @endauth

        </div>
    </div>
@endsection
