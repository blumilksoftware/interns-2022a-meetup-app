@extends('layouts.app')

@section('content')
    <div>
        <h1>Contact Us</h1>
        @if(session()->has('message'))
            <div>
                {{ session()->get('message') }}
            </div>
        @endif
        <form action="{{ route('contact.store') }}" method="post">
            @csrf
            <div>
                <label for="name">Name:</label>
                <input type="text" name="name" id="name" value="{{ old('name') }}">
                <x-input-error for="name"/>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                <x-input-error for="email"/>
            </div>
            <div>
                <label for="subject">Subject:</label>
                <input type="text" name="subject" id="subject" value="{{ old('subject') }}">
                <x-input-error for="subject"/>
            </div>
            <div>
                <label for="message">Message:</label>
                <textarea name="message" id="message" rows="4">{{ old('message') }}</textarea>
                <x-input-error for="message"/>
            </div>
            <input type="submit" name="send" value="Send">
        </form>
    </div>
@endsection
