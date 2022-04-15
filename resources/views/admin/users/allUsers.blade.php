<x-admin-master>
@section('content')
<h1> All Users</h1>

  @if(Session::has('userDeleteMessage'))
  <div class="alert alert-danger">
    {{session::get('userDeleteMessage')}}
  </div>
  @endif


          <!-- DataTales Example -->
          <div class="card shadow mb-4">
            <div class="card-header py-3">
              <h6 class="m-0 font-weight-bold text-primary">All Users</h6>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                    <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Registered At</th>
                    <th>Options</th>
                    </tr>
                  </thead>
                  <tfoot>
                    <tr>
                    <th>User ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Image</th>
                    <th>Registered At</th>
                    <th>Options</th>
                    </tr>
                  </tfoot>
                  <tbody>
                    @foreach($users as $user)
                    <tr>
                              <td>{{$user->id}}</td>
                              <td>{{$user->name}}
                              @can('canViewProfiles',$user)
                              <a href="{{route('users.profiles.showAny',$user->id)}}"><span class="fa fa-eye"></span></a></td>
                              @endcan
                              <td>{{$user->email}}</td>
                              <td><img src="{{$user->avatar}}" width="100"  alt=""></td>
                              <td>{{$user->created_at->diffForHumans()}}</td>
                              <td>
                                @can('delete',$user)
                                <form action="{{route('user.delete',$user->id)}}" method="post" >
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
           {{$users->links('pagination::bootstrap-4')}}
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