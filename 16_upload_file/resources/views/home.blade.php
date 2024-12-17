<div>
    @if(session('status'))
        <h1>{{session('status')}}</h1>
    @endif
    <a href="{{route('profile-pic.create')}}">
        <button>Upload Profile Pictures</button>
    </a>
    <br><br>
    @if ($profilePics->isEmpty())
        <h1>No profile pictures uploaded yet</h1>
    @else        
        @foreach ($profilePics as $profilePic)
            <div>
                <img src="{{asset("storage/images/$profilePic->profile_pic")}}" alt="">
                <br>
                <a href="{{route('profile-pic.edit',$profilePic->id)}}"><button>Edit</button></a>
                <form action="{{route('profile-pic.destroy', $profilePic->id)}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button>delete</button>
                </form>
            </div>
            <br>
        @endforeach
    @endif
</div>