<x-layout>

    <x-slot:title>Profile</x-slot>

    <x-slot:main>

        <div class="profile-container d-flex justify-content-center my-3">
            <img id="image" src="{{asset("storage/images/$user->photo")}}" alt="" class="img-fluid img-responsive rounded-circle" style="height: 200px; width: 200px;" >
        </div>

        <form action="{{ route('user.profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="row">
            <x-form.input type="text" name="name" placeholder="Jhon" value="{{Auth::user()->name}}" />
            <x-form.input type="email" name="email" placeholder="test@gmail.com" value="{{Auth::user()->email}}" />
            <x-form.input type="file" name="photo" />
        </div>
        <x-form.button>Update</x-form.button>
        </form>
    </x-slot>
</x-layout>
