@extends('layouts.app')

@section('content')
    <div class="container md:w-[800px] mx-auto">
        <div class="bg-white p-6 mt-20 rounded-20 shadow-xl">
            <div>
                <a href="{{ route('news') }}">Go back to News</a>
            </div>
            <div>
                {{ $news->title }}
            </div>
            <div>
                {!! Str::markdown($news->text) !!}
            </div>
            <div>
                Author: {{ $news->user->name }}
            </div>

        </div>
    </div>
@endsection