@component('mail::message')
<h3>Hello {{$email}}</h3>
<p>New news has been created</p>
<p>Title {{$title}}</p>
@component('mail::button', ['url' => $url])
    Click here for details
@endcomponent
<p>if you want to unsubscribe click here</p>
@component('mail::button', ['url' => route("newsletter.unsubscribe",["email" => $email])])
    Click here to unsubscribe
@endcomponent
@endcomponent