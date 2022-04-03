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
            <label for="Notification type">Notification type:</label>
            <div>
                <label for="News">New News
                <input type="radio" name="type" id="News" checked="checked" value="News"></label>
                <x-input-error for="type"/>
                <label for="News">New Meetups
                    <input type="radio" name="type" id="Meetups" value="Meetups"></label>
                <x-input-error for="type"/>
            </div>
            <input type="submit" name="Subscribe" value="Subscribe">
        </form>
    </div>
@endsection