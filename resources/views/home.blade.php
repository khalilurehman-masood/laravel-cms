
@extends('components/home-master')


@section('content')
<div class="col-md-8 mt-4">
  @if(count($posts)>0)
      @foreach($posts as $post)
        <!-- Blog Post -->
        <div class="card mb-4">
          <img class="card-img-top" src="{{$post->post_image}}" alt="Card image cap">
          <div class="card-body">
            <h2 class="card-title">{{$post->title}}</h2>
            
            
            <p class="card-text">{{Str::limit(strip_tags($post->body),100,'....')}}</p>
            <a href="{{Route('post',$post->slug)}}" class="btn btn-primary">Read More &rarr;</a>
          </div>
          <div class="card-footer text-muted">
            Posted on {{$post->created_at}} by
            <a href="#">{{$post->user->name}}</a>
          </div>
        </div>
@endforeach
@else
<h1 class="text-center">No posts to show ....!</h1>
@endif
        <!-- Pagination -->
        <ul class="pagination justify-content-center mb-4">
          <li class="page-item">
            <a class="page-link" href="#">&larr; Older</a>
          </li>
          <li class="page-item disabled">
            <a class="page-link" href="#">Newer &rarr;</a>
          </li>
        </ul>

</div>




@endsection


