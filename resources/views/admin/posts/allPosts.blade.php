<x-admin-master>
@section('content')
<h1 class="text-center"> All Posts</h1>

  @if(Session::has('postDeleteMessage'))
  <div class="alert alert-danger">
    {{session::get('postDeleteMessage')}}
  </div>
  @elseif(Session::has('postCreateMessage'))
  <div class="alert alert-success">
    {{session::get('postCreateMessage')}}
  </div>
  @elseif(Session::has('postUpdateMessage'))
  <div class="alert alert-success">
    {{session::get('postUpdateMessage')}}
  </div>
  @elseif(Session::has('unauthorized'))
  <div class="alert alert-success">
    {{session::get('unauthorized')}}
  </div>
  @endif


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All posts</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>title</th>
                    <th>body</th>
                    <th>image</th>
                    <th>Author</th>
                    <th>Created At</th>
                    <th>Options</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>title</th>
                    <th>body</th>
                    <th>image</th>
                    <th>Author</th>
                    <th>Created At</th>
                    <th>Options</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($posts as $post)
                    <tr>
                              <td>{{Str::limit($post->title,20)}}
                              @if(auth()->user()->id==$post->user->id)
                              <a href="{{route('post.edit',$post)}}">
                              <span class="fa fa-edit"></span>
                              </a>
                              @endif
                              </td>

                              <td>{{Str::limit(strip_tags($post->body),20)}} <a href="{{Route('post',$post->slug)}}"><span class="fa fa-eye"></span></a></td>
                              <td><img src="{{$post->post_image}}" width="200"  alt=""></td>
                              <td>{{$post->user->name}}</td>
                              <td>{{$post->created_at->diffForHumans()}}</td>
                              <td>
                                @can('delete',$post)
                                <form action="{{route('post.delete',$post->id)}}" method="post" >
                                  @csrf
                                  @method('Delete')
                                  <button type="submit" class="btn btn-danger">
                                    Delete
                                  </button>
                                </form>
                                @endcan
                              </td>
                    </tr>


                    @endforeach
          </tbody>
                </table>
              </div>
            </div>
           <div class="d-flex justify-content-center">
           {{$posts->links('pagination::bootstrap-4')}}
           </div>
          </div>

@endsection
@section('dataTableScripts')
  <!-- Page level plugins -->
  <script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>

  <!-- Page level custom scripts for pagination etc. -->
  <!-- <script src="{{asset('js/chartsAndDatatablesScripts/datatables.js')}}"></script> -->
@endsection
</x-admin-master>