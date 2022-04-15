<x-admin-master>
@section('content')
<h3>Edit Post</h3>

<form method="POST" action="{{route('post.update',$post->id)}}" enctype="multipart/form-data" >
          @csrf
          @method('Patch')
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" value="{{$post->title}}">
</div>
<div class="form-group">
    <label for="image">Image</label>
    <img src="{{$post->post_image}}" alt="" height="200">
    <input type="file" class="form-control-file" name="post_image">
</div>


<div class="form-group">
    <label for="body">Body</label>
    <div class="form-group">
    <input id="x" type="hidden" name="body" value="{{$post->body}}">
    <trix-editor  input="x" class="trix-content"></trix-editor>
    </div>
</div>
<div class="form-group">
   <input type="submit" class="btn btn-primary" name="editPost">
</div>

  
</form>
@endsection
</x-admin-master>