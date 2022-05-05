@component('mail::message')
<h3>Hello {{$email}}</h3>
<p>Thank you for subscribing to our newsletter</p>
@component('mail::button', ['url' => route("meetups")])
    Click here if you want to go to our page
@endcomponent
@component('mail::button', ['url' => route("newsletter.unsubscribe",["email" => $email])])
    Click here to unsubscribe
@endcomponent
@endcomponent
