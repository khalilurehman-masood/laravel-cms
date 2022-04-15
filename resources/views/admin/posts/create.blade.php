<x-admin-master>
@section('content')
<h3>create</h3>

<form method="POST" action="{{route('post.create')}}" enctype="multipart/form-data" >
          @csrf
<div class="form-group">
    <label for="title">Title</label>
    <input type="text" class="form-control" name="title" placeholder="your post title">
</div>
<div class="form-group">
    <label for="image">Image</label>
    <input type="file" class="form-control-file" name="post_image">
</div>


<div class="form-group">
    <label for="body">Body</label>
    <div class="form-group">
    <input id="x" type="hidden" name="body" value="">
    <trix-editor  input="x" class="trix-content"></trix-editor>
    </div>
</div>

<label for="form-check">Select Category</label>
<div class="form-group" id="form-check">
@foreach($categories as $category)
<div class="form-check" >
<input type="checkbox" class="form-check-input" id="{{$category->id}}" name="categories[]" value="{{$category->id}}">
<label class="form-check-label" for="{{$category->id}}">{{$category->name}}</label>
</div>
@endforeach
</div>

<div class="form-group">
   <input type="submit" class="btn btn-primary" name="createPost">
</div>
</form>
@endsection
</x-admin-master>