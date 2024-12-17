<div>
    <h1>Update Profile Picture</h1>
    <br>
    <div>
        <h2></h2>
        <img src="{{asset("storage/images/$profilePic->profile_pic")}}" alt="">
    </div>
    <br>
    <form action="{{route('profile-pic.update', $profilePic->id)}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="file" name="photo" />
        <br><br>
        <button type="submit">update picture</button>
    </form>
</div>