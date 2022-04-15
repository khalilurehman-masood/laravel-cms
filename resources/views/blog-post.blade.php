@extends('components/home-master')
 @section('content')
 <div class="col-lg-8">

<!-- Title -->
<h1 class="mt-4">{{$post->title}}</h1>

<!-- Author -->
<p class="lead">
  by
  <a href="#">{{$post->user->name}}</a>
</p>

<hr>

<!-- Date/Time -->
<p>Posted on {{$post->created_at}}</p>

<hr>

<!-- Preview Image -->
<img class="img-fluid rounded" src="{{$post->post_image}}" alt="">

<hr>

<!-- Post Content -->
<p class="lead">@php echo $post->body @endphp</p>



<hr>

<!-- Comments Form -->
<div class="card my-4">
  <h5 class="card-header">Leave a Comment:</h5>
  <div class="card-body">
    <form action="{{route('comment.create',$post->id)}}" method="POST">
    @csrf
    <div class="form-group">
      <label for="authorName">Your Name</label>
      <input type="text" class="form-control" id="authorName" name="author">
    </div>
    <div class="form-group">
      <label for="authorEmail">Your Email</label>
      <input type="email" class="form-control" id="authorEmail" name="email">
    </div>
    <div class="form-group">
    <label for="body">Comment</label>
      <textarea class="form-control" rows="3" name="body" id="body"></textarea>
    </div>
    <div class="form-group">
      <button type="submit" class="btn btn-primary mt-1">Comment</button>
    </div>
    </form>
  </div>
</div>

<div class="card mb-4">
    <div class="card-body p-4">
     
@foreach($comments as $comment)
            <div class="row">
              <div class="col">
                <div class="d-flex flex-start">
                  <img class="rounded-circle shadow-1-strong me-3"
                    src="{{asset('user_avatars/User.png')}}" alt="avatar" width="65"
                    height="65" />
                  <div class="flex-grow-1 flex-shrink-1">
                    <div>
                      <div class="d-flex justify-content-between align-items-center">
                        <p class="mb-1">
                          {{$comment->author}} <span class="small">- {{$comment['created_at']->diffForHumans() }}</span>
                        </p>
                        @if(auth()->user())
                        @if(auth()->user()->id == $post->user->id)
                        <a href="#commentReplyModal" class="commentReplyLink" data-id="{{$comment->id}}" data-target="#commentReplyModal" data-toggle="modal">
                        <i class="fas fa-reply fa-xs"></i><span class="small"> reply</span>
                        </a>
                        @endif
                        @endif
                      </div>
                      <p class="small mb-0">
                        {{$comment->body}}
                      </p>
                    </div>
                    @if($comment->replies())
                    @foreach($comment->replies as $reply)
                    <div class="d-flex flex-start mt-4">
                      <a class="me-3" href="#">
                        <img class="rounded-circle shadow-1-strong"
                          src="{{$post->user->avatar}}" alt="avatar" width="65" height="65" />
                      </a>
                      <div class="flex-grow-1 flex-shrink-1">
                        <div>
                          <div class="d-flex justify-content-between align-items-center">
                            <p class="mb-1">
                              {{$reply->author}} <span class="small">{{$reply->created_at->diffForHumans()}}</span>
                            </p>
                            @if(auth()->user())
                        @if(auth()->user()->id == $post->user->id)
                        <a href="#commentReplyEditModal" class="commentReplyEditLink" data-id="{{$reply->id}}" body="{{$reply->body}}" data-target="#commentReplyEditModal" data-toggle="modal">
                        <i class="fas fa-reply fa-xs"></i><span class="small">Edit Reply</span>
                        </a>
                        @endif
                        @endif
                          </div>
                          <p class="small mb-0">
                            {{$reply->body}}
                          </p>
                        </div>
                      </div>
                    </div>
                    @endforeach
                    @endif

                  </div>
                </div>
              </div>
            </div>
            <hr>
        @endforeach
        </div>
      </div> 
</div>

<!-- comment reply Modal -->
<div class="modal fade" id="commentReplyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Reply</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('comment.reply')}}" method="post">  
          @csrf
          <div class="form-group">
        <label for="reply">Post Reply</label>
        <textarea name="reply" id="reply" cols="" rows="5" class="form-control"></textarea>
        <input type="hidden" name="commentId" id="commentId" value="">
        </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> 
          <button class="btn btn-danger" type="submit">Reply</button>
          </form>
        </div>
      </div>
    </div>
  </div>

  <!-- comment reply Edit Modal -->
<div class="modal fade" id="commentReplyEditModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Edit Reply</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">
        <form action="{{route('comment.reply.edit')}}" method="post">
          @method('patch')  
          @csrf
          <div class="form-group">
        <label for="reply">Edit Reply</label>
        <textarea name="reply" id="replyBody" cols="" rows="5" class="form-control"></textarea>
        <input type="hidden" name="replyId" id="replyId" value="">
        </div>
        </div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button> 
          <button class="btn btn-danger" type="submit">Edit Reply</button>
          </form>
        </div>
      </div>
    </div>
  </div>

<script src="{{asset('vendor/jquery/jquery.js')}}"></script>
<script>


$(document).ready(function () {
$('.commentReplyLink').click(function () {
var commentId = $(this).attr('data-id');
$("#commentId").attr("value", commentId);
});
});

$(document).ready(function () {
$('.commentReplyEditLink').click(function () {
var replyId = $(this).attr('data-id');
var replyBody=$(this).attr('body');
$("#replyBody").text(replyBody);
$("#replyId").attr("value",replyId);
});
});
</script>

@endsection
