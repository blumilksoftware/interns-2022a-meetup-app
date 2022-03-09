@extends('layouts.app')

@section('content')
    <div style="text-align: center">
        <h1>You have been registered<br>Please go to login Page</h1>
        <a href="{{ route('login') }}"><button type="button">Login</button></a>

    </div>
@endsection

