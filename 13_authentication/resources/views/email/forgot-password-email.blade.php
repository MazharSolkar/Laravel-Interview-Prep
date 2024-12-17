<x-layout>

    <x-slot:title>Forogot Password Email</x-slot>

    <x-slot:main>
        <h1>Hello {{$mailData['user']}}</h1>
        <p>Clikc below to change your password.</p>

        <a href="{{route('user.reset.password.form', $mailData['token'])}}">Click Here</a>

        <p>Thanks</p>
    </x-slot>

</x-layout>
