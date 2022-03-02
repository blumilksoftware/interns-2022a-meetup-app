@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Register</h1>
            <form action="{{ route('register') }}" method="post">
                @csrf
                <div>
                    <a href="{{ route('login.google') }} ">Sing up with google</a>
                    <a href="{{ route('login.facebook') }} ">Sing up with Facebook</a>
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
                    <label for="name">name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name') }}">
                    @error('name')
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
                    <label for="confirm_password">confirm_password:</label>
                    <input type="text" id="confirm_password" name="confirm_password" value="{{ old('confirm_password') }}">
                    @error('confirm_password')
                    <div>
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div>
                    <button type="submit">Create</button>
                </div>
            </form>
        </div>
    </div>
    @endsection

