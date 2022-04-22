@extends('layouts.app')

@section('content')
    <div>
        <h1>Newsletter Page</h1>
        @if(session()->has('message'))
            <div>
                {{session()->get('message')}}
            </div>
        @endif
        <form action="{{route("newsletter.update")}}" method="post">
            @csrf
            <input type="email" hidden="hidden"  name="email" id="email" value="{{ $subscriber->email }}">
            <label for="Notification_type">What would you like to subscribe?</label>
            <div>
                <label for="News">New News
                    <input type="checkbox" name="type[]" id="News" checked="checked" value={{AvailableNewsletter::News->value}}></label>
                <label for="News">New Meetups
                    <input type="checkbox" name="type[]" id="Meetups" value={{AvailableNewsletter::Meetups->value}}></label>
                <x-input-error for="type"/>
            </div>
            <input type="submit" name="Subscribe" value="Subscribe">
        </form>
    </div>
@endsection
