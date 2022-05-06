@extends('layouts.app')

@section('content')
    <div class="container sm:w-[1216px] mx-auto px-5 xl:px-0">
        <h1>Dashboard</h1>
        <div>
            <a href="{{ route('admin.users') }}">Users</a>
            <a href="{{ route('admin.meetups') }}">Meetups</a>
            <a href="{{ route('admin.organizations') }}">Organizations</a>
            <a href="{{ route('admin.speakers') }}">Speakers</a>
        </div>
    </div>
@endsection
