<h1>Home Page</h1>
<div>
    @foreach ($posts as $post)
    <div style="border:2px solid gray; margin:4px;">    
        <h3>{{$post->title}}</h3>
        <p>{{$post->body}}</p>

        @can('edit-post', $post)
        <a href="{{route('post.editForm', ['post'=>$post->id])}}">
            <button style="background: cyan">edit</button>
        </a>
        @endcan
    </div>
    @endforeach
</div>
