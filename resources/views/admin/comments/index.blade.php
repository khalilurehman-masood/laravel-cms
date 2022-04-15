<x-admin-master>
@section('content')
<h1 class="text-center"> All Commets</h1>

@if(Session::has('commentDeleteMessage'))
<div class="alert alert-danger">
{{session::get('commentDeleteMessage')}}
</div>
@endif

@if($comments != null)
          <!-- DataTales  -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">All Comments</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Comment ID</th>
<th>Author</th>
<th>Email</th>
<th>Post Id</th>
<th>Body</th>
<th>Created  At</th>
<th>Status</th>
<th>Options</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Comment ID</th>
<th>Author</th>
<th>Email</th>
<th>Post Id</th>
<th>Body</th>
<th>Created  At</th>
<th>Status</th>
<th>Options</th>
</tr>
</tfoot>
<tbody>
@foreach($comments as $comment)
<tr>
<td>{{$comment->id}}</td>
<td>{{$comment->author}}
<td>{{$comment->email}}</td>
<td>{{$comment->post_id}}</td>
<td>{{$comment->body}}</td>
<td>{{$comment->created_at->diffForHumans()}}</td>
<td>
<form action="{{route('comment.changeStatus',$comment->id)}}" method="post" >
@csrf
@method('patch')
<button type="submit" class="btn btn-secondary">
{{ucfirst($comment->status)}}
</button>
</form>       
</td>
<td>
<form action="{{route('comment.delete',$comment->id)}}" method="post" >
@csrf
@method('Delete')
<button type="submit" class="btn btn-danger">
Delete
</button>
</form>  
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<div class="d-flex justify-content-center">
{{$comments->links('pagination::bootstrap-4')}}
</div>
</div>
@else
<h1>There are no comments to display</h1>

@endif
@endsection
@section('dataTableScripts')
<!-- Page level plugins -->
<script src="{{asset('vendor/datatables/jquery.dataTables.js')}}"></script>
<script src="{{asset('vendor/datatables/dataTables.bootstrap4.js')}}"></script>

<!-- Page level custom scripts for pagination etc. -->
<!-- <script src="{{asset('js/chartsAndDatatablesScripts/datatables.js')}}"></script> -->
@endsection
</x-admin-master>