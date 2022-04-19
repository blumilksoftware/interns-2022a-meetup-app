@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Create News</h1>
            <form action="{{ route('news.store') }}" method="post" id="createNews">
                @csrf
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}">
                    <x-input-error for="name"/>
                </div>
                    <label for="editor">Content:</label>
                    <div class="flex flex-col space-y-2">
                        <div id="editor" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm"></div>
                    </div>
                    <x-input-error for="editor"/>
                <input type="hidden" name="content" id="content">
                <div>
                    <button type="submit">Post</button>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset('static/js/app.js') }}"></script>
@endsection
