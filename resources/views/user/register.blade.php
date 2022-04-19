@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Sing Up Page</h1>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div>
                    <a href="{{ route('login.google') }}"><button type="button">Sign up with Google</button></a>
                    <a href="{{ route('login.facebook') }}"><button type="button">Sign up with Facebook</button></a>
                </div>
                <div>
                    <label for="email">email:</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}">
                    <x-input-error for="email"/>
                </div>
                <div>
                    <label for="name">name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}">
                    <x-input-error for="name"/>
                </div>
                <div>
                    <label for="password">password:</label>
                    <input type="password" id="password" name="password" value="{{ old('password') }}">
                    <x-input-error for="password"/>
                </div>
                <div>
                    <label for="confirm_password">password_confirmation :</label>
                    <input type="password" id="password_confirmation" name="password_confirmation" value="{{ old('password_confirmation') }}">
                    <x-input-error for="password_confirmation"/>
                </div>
                <div>
                    <button type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
    @endsection
