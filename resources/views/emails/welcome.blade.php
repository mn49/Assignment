@component('mail::message')

<h1 align="center">Hello {{ $user->name }}</h1>

<h3 align="center">Welcome to the LSAPPS.</h3>

<p align="justify">We are happy to have you join us today, but before we get started, we need to make sure that your email is real (or you can say validated)</p>

<p align="center">Please press the button below to verify your email address</p>

@component('mail::button', ['url' => 'www.google.com'])
Verify
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
