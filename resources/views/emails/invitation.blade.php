<h3>Hello {{$receiver}}</h3>
<p>You have received an email from: {{ $sender->name }}</p>
<p>Email: {{ $sender->email }}</p>
<p>Click here to register <a href="{{route("register",["email" => $receiver])}}"><button>Register</button></a></p>