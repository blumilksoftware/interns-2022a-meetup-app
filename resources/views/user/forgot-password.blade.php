@extends('layouts.app')

@section('content')
    <div>
        <div>
            <h1>Forgot Password Page</h1>
            <form action="{{ route('password.email') }}" method="post">
                @csrf
                <div>
                    <label for="email">email:</label>
                    <input type="text" id="email" name="email" value="{{ old('email') }}">
                    <x-input-error for="email"/>
                </div>
                <div>
                    <button type="submit">Reset Password</button>
                </div>
                @if(!empty($error))
                    <div>{{$error}}</div>
                @endif
            </form>
        </div>
    </div>
@endsection
