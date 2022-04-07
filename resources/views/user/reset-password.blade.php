@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Forgot Password Page</h1>
            <form action="{{ route('password.email') }}" method="post">
                @csrf
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
                    <button type="submit">Set New Password</button>
                </div>
                @if(!empty($error))
                    <div>{{$error}}</div>
                @endif
            </form>
        </div>
    </div>
@endsection
