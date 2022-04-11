@extends('layouts.app')

@section('content')
    <div>
        <h1>Newsletter Page</h1>
        @if(session()->has('message'))
            <div>
                {{session()->get('message')}}
            </div>
        @endif
        <form id="newsletterForm" action="" method="post">
            @csrf
            <div>
                <label for="email">Email:</label>
                <input type="email" name="email" id="email" value="{{ old('email') }}">
                <x-input-error for="email"/>
            </div>
            <input type="submit" name="Subscribe" value="Subscribe" onclick="subscribe()">
            <input type="submit" name="Unsubscribe" value="Unsubscribe" onclick="unsubscribe()">
        </form>
        <script>
            form=document.getElementById("newsletterForm");
            function subscribe() {
                form.action="{{ route('newsletter.store') }}";
                form.submit();
            }
            function unsubscribe() {
                form.action="{{ route('newsletter.destroy') }}";
                form.submit();
            }

        </script>
    </div>
@endsection

