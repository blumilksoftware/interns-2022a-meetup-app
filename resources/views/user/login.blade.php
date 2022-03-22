@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Login Page</h1>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div>
                    <a href="{{ route('login.google') }}"><button type="button">Sign in with Google</button></a>
                    <a href="{{ route('login.facebook') }}"><button type="button">Sign in with Facebook</button></a>
                </div>
                <div>
                    <label for="email">email:</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}">
                    <x-input-error for="email"/>
                </div>
                <div>
                    <label for="password">password:</label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}">
                    <x-input-error for="password"/>
                </div>
                <div>
                    <button type="submit">Login</button>
                </div>
                @if(!empty($error))
                    <div>{{$error}}</div>
                @endif
            </form>
        </div>
    </div>
    @endsection
