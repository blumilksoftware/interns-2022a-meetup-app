@extends('layouts.app')

@section('content')
    <div style="text-align: center">
        <h1>You have been registered<br>Please verify your email address</h1>
        <a href="{{ route('login') }}"><button type="button">Login Page</button></a>
    </div>
@endsection
