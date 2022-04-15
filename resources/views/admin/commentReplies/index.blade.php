<x-admin-master>
@section('content')
<h1 class="text-center">Replies</h1>

@if(Session::has('replyDeleteMessage'))
<div class="alert alert-danger">
{{session::get('replyDeleteMessage')}}
</div>
@endif

@if(!empty($replies))
          <!-- DataTales  -->
<div class="card shadow mb-4">
<div class="card-header py-3">
<h6 class="m-0 font-weight-bold text-primary">Replies</h6>
</div>
<div class="card-body">
<div class="table-responsive">
<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
<thead>
<tr>
<th>Reply ID</th>
<th>Author</th>
<th>Email</th>
<th>Comment Id</th>
<th>Body</th>
<th>Created  At</th>
<th>Option</th>
</tr>
</thead>
<tfoot>
<tr>
<th>Reply ID</th>
<th>Author</th>
<th>Email</th>
<th>Comment Id</th>
<th>Body</th>
<th>Created  At</th>
<th>Option</th>
</tr>
</tfoot>
<tbody>
@foreach($replies as $reply)
<tr>
<td>{{$reply->id}}</td>
<td>{{$reply->author}}
<td>{{$reply->email}}</td>
<td>{{$reply->comment_id}}</td>
<td>{{$reply->body}}</td>
<td>{{$reply->created_at->diffForHumans()}}</td>
<td>
@if(auth()->user()->email==$reply->email)
<form action="{{route('reply.delete',$reply->id)}}" method="post" >
@csrf
@method('Delete')
<button type="submit" class="btn btn-danger">
Delete
</button>
</form>  
@endif
</td>
</tr>
@endforeach
</tbody>
</table>
</div>
</div>
<div class="d-flex justify-content-center">
{{$replies->links('pagination::bootstrap-4')}}
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
@else
<h1>There are no comments to display</h1>

@endif

</x-admin-master>