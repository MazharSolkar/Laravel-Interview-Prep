<x-layout>

    <x-slot:title>Reset Password</x-slot>

    <x-slot:main>
        <form action="{{ route('user.reset.password', $token) }}" method="POST">
            @csrf
            <div class="row">
                <x-form.input name="password" type="password" placeholder="test@gmail.com" />
                <x-form.input name="password_confirmation" type="password" placeholder="********" />
            </div>

            <x-form.button>Reset</x-form.button>
        </form>
    </x-slot>

</x-layout>
