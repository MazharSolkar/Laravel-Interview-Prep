<x-layout>

    <x-slot:title>Forgot Password</x-slot>

    <x-slot:main>
        <form action="{{ route('user.forgot.password.email') }}" method="POST">
            @csrf
            <div class="row">
                <x-form.input name="email" type="email" placeholder="test@gmail.com" />
            </div>
            <x-form.button>Submit</x-form.button>
        </form>
    </x-slot>

    </x-layout>
