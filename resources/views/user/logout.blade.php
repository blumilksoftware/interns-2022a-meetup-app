@extends('layouts.app')

@section('content')
    <div style="text-align: center">
        <h1>You have been successfully loged out</h1>
        <a href="{{ route('meetups') }}"><button type="button">Home Page</button></a>
    </div>
@endsection
