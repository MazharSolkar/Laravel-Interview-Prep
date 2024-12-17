<x-layout>

<x-slot:title>Login</x-slot>

<x-slot:main>
    <form action="{{ route('user.login') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <x-form.input name="email" type="email" placeholder="test@gmail.com" />
            <x-form.input name="password" type="password" placeholder="********" />
        </div>
        <x-form.button>Login</x-form.button>
    </form>

    <p>Don't have an account? <a href="{{route('user.register.form')}}" style="text-decoration:none;">SignUp</a></p>

    <a href="{{route('user.forgot.password.form')}}" style="text-decoration:none;">
        Forgot Password?
    </a>
</x-slot>

</x-layout>
