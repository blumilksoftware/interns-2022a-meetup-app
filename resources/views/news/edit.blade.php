@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Edit News</h1>
            <form method="post" action="{{ route('news.update', $news) }}"  id="editNews">
                @method('PUT')
                @csrf
                <div>
                    <label for="name">Title:</label>
                    <input type="text" id="title" name="title" value="{{ old('title', $news->title) }}">
                    <x-input-error for="name"/>
                </div>
                <label for="editor">Content:</label>
                <div class="flex flex-col space-y-2">
                    <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                </div>
                <x-input-error for="editor"/>
                <input type="hidden" id="oldContent" value="{!! \Illuminate\Support\Str::markdown($news->content) !!}">
                <input type="hidden" name="content" id="content">
                <div>
                    <button type="submit">Update</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('static/js/app.js') }}"></script>
@endsection
