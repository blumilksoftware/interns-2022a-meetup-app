@extends('layouts.app')

@section('content')
    <div style="text-align: center">
        <h1>{{$message->content()}}</h1>
    </div>
@endsection
