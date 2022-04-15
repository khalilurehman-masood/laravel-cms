<x-admin-master>
@section('content')
<h1 class="text-center">Roles</h1>
<hr>
<div class="row">
<div class="col-md-6">
<h2>All roles</h2>
@error('deleteError')
<div class="alert alert-danger">
{{message}}
</div>
@enderror
<ul>
@foreach($roles as $role)
<li>
          @if($role->slug=='admin'|| $role->slug=='simpleuser')
          {{$role->name}}
          @else

          {{$role->name}}
          <a  href="#roleDeleteModel" class="roleDeleteLink" data-toggle="modal" data-id="{{$role->id}}" data-target="#roleDeleteModal">
          <i class="fas  fa-sm fa-trash"></i>
          </a>


          </li>
          @endif
@endforeach
</ul>
</div>

<div class="col-md-6">
<h2>Create New Role</h2>
<form action="{{route('roles.create')}}" method="post">
          @csrf
          <div class="form-group">
                    <label for="roleName">Role Name</label>
                    <input type="text" class="form-control  @error('roleName') is-invalid @enderror" name="roleName" id="roleName">
                    @error('roleName')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
          </div>

          <div class="form-group">
                    <label for="roleSlug">Role Slug</label>
                    <input type="text" class="form-control  @error('roleSlug') is-invalid @enderror" name="roleSlug" id="roleSlug">
                    @error('roleSlug')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
          </div>
          <div class="form-group text-center">
                    <button class="btn btn-primary" type="submit">Create Role</button>
          </div>
</form>
</div>
</div>

  <!-- role Delete Modal -->
  <div class="modal fade" id="roleDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Do you really want to delete the role from database</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form action="{{route('roles.delete')}}" method="post">
                    @method('delete')
                    @csrf
                    <input type="hidden" name="roleId" id="roleId" value="">
          <button class="btn btn-danger" type="submit">Delete</button>
          </form>
        </div>
      </div>
    </div>
  </div>
  <script src="{{asset('vendor/jquery/jquery.js')}}"></script>
  <script>
//             $(document).on("click", ".roleDeleteLink", function () {
//      var role_id = $(this).data('id');
//      $(".modal-body #roleId").val(role_id);

     // As pointed out in comments, 
     // it is unnecessary to have to manually call the modal.
     // $('#addBookDialog').modal('show');
// });

$(document).ready(function () {
    $('.roleDeleteLink').click(function () {
        var roleId = $(this).attr('data-id');
        console.log(roleId);
        $("#roleId").attr("value", roleId);
    });
});
  </script>

@endsection
</x-admin-master>