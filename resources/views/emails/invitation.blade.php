@component('mail::message')
    <h3>Hello {{$receiver}}</h3>
    <p>You have received an email from: {{ $sender->name }}</p>
    <p>Email: {{ $sender->email }}</p>
    <p>You are invited to meetup page</p>
    @component('mail::button', ['url' => route("register", ["email" => $receiver])])
        <p>Click here to register</p>
    @endcomponent
@endcomponent
