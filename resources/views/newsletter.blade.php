@extends('layouts.app')

@section('content')
    <div>
        <h1>Newsletter Page</h1>
        @if(session()->has('message'))
            <div>
                {{session()->get('message')}}
            </div>
        @endif
        <form action="{{ route('newsletter.store') }}" method="post">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                <x-input-error for="email"/>
            </div>
            <input type="submit" name="Subscribe" value="Subscribe">
        </form>
    </div>
@endsection