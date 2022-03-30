@extends('layouts.app')

@section('content')
    <div>
        <a href="{{ route('logout') }}"><button type="button">Log Out</button></a>
    </div>
    <div style="text-align: center">
        <h1>Hello in meetup app</h1>
    </div>
@endsection
