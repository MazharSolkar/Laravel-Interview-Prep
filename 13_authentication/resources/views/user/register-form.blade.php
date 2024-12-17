<x-layout>

    <x-slot:title>Register</x-slot>

    <x-slot:main>
        <form action="{{ route('user.register') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <x-form.input type="text" name="name" placeholder="Jhon" value="{{old('name')}}" />
            <x-form.input type="email" name="email" placeholder="test@gmail.com" value="{{old('email')}}" />
            <x-form.input type="file" name="photo" value="{{old('photo')}}" />
            <x-form.input type="password" name="password" placeholder="********" value="{{old('password')}}" />
            <x-form.input type="password" name="password_confirmation" placeholder="********" value="{{old('password_confirmation')}}" />
        </div>
        <x-form.button>Register</x-form.button>
        </form>

        <p>Already have an account? <a href="{{route('user.login.form')}}" style="text-decoration:none;">Login</a></p>

    </x-slot>
</x-layout>
