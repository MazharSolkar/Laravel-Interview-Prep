<x-layout>

    <x-slot:title>Home Page</x-slot>

    <x-slot:main>
        <div>
            @if(Auth::check())
            <form action="{{route('user.logout')}}" method="POST">
                @csrf
                <x-form.button color="danger">Logout</x-form.button>
            </form>
            @else
            <a href="{{route('user.login.form')}}" style="text-decoration: none;">
                <x-form.button color="success">Login</x-form.button>
            </a>
            @endif
            {{Auth::check()? Auth::user()->name.' is logged in' : 'user is logged out'}}
        </div>
    </x-slot:main>

</x-layout>
