@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Create News</h1>
                <form action="{{ route('news.store') }}" method="post" enctype="multipart/form-data">
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
                        <button type="submit">Post</button>
                    </div>
                </form>
        </div>
    </div>
    @include('components.ckeditor')
@endsection