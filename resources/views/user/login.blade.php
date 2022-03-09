@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Login Page</h1>
            <form action="{{ route('login') }}" method="post">
                @csrf
                <div>
                    <a href="{{ route('login.google') }}"><button type="button">Sing in with google</button></a>
                    <a href="{{ route('login.facebook') }}"><button type="button">Sing in with Facebook</button></a>
                </div>
                <div>
                    <label for="email">email:</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}">
                    @error('email')
                    <div>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <label for="password">password:</label>
                    <input type="text" id="password" name="password" value="{{ old('password') }}">
                    @error('password')
                    <div>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <button type="submit">Login</button>
                </div>
            </form>
        </div>
    </div>
    @endsection

