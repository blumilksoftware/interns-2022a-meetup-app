@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Edit News</h1>
            @auth
            <form method="post" action="{{ route('news.update', $news) }}" enctype="multipart/form-data">
                @method('PUT')
                @csrf
                @csrf
                <div>
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}">
                    <x-input-error for="name"/>
                </div>
                <div>
                    <label for="content">Content:</label>
                    <textarea class="ckeditor form-control" name="content">{{ old('content') }}</textarea>
                    <x-input-error for="content"/>
                </div>
                <div>
                    <button type="submit">Update</button>
                </div>
            </form>
            @endauth
        </div>
    </div>
    @include('components.ckeditor')
@endsection
