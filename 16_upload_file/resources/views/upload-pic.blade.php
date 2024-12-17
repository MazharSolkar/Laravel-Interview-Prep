<h1>Upload Profile Picture</h1>

<form action="{{route('profile-pic.store')}}" method="POST" enctype="multipart/form-data">
    @csrf
    <label for="photo">select image</label>
    <input type="file" name="photo" />
    @error('photo') <span style="color:red">{{$message}}</span>@enderror
    <br><br>
    <button type="submit" style="background: blue;color:white;">Upload Profile Picture</button>
</form>