

<x-admin-master>
@section('content')
<h1 class="text-center">Categories</h1>
<hr>
<div class="row">
<div class="col-md-6">
<h2>All Categories</h2>
@error('deleteError')
<div class="alert alert-danger">
{{message}}
</div>
@enderror
<ul>
@foreach($categories as $category)
          <li>
          {{$category->name}}
          <a  href="#categoryDeleteModel" class="categoryDeleteLink" data-toggle="modal" data-id="{{$category->id}}" data-target="#categoryDeleteModal">
          <i class="fas  fa-sm fa-trash"></i>
          </a>
          </li>
@endforeach
</ul>
</div>

<div class="col-md-6">
<h2>Create New Category</h2>
<form action="{{route('categories.create')}}" method="post">
          @csrf
          <div class="form-group">
                    <label for="categoryName">Category Name</label>
                    <input type="text" class="form-control  @error('categoryName') is-invalid @enderror" name="categoryName" id="categoryName">
                    @error('categoryName')
                    <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                    </span>
                    @enderror
          </div>
          <div class="form-group text-center">
                    <button class="btn btn-primary" type="submit">Create Category</button>
          </div>
</form>
</div>
</div>

  <!-- role Delete Modal -->
  <div class="modal fade" id="categoryDeleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Do you really want to delete this category from database</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <form action="{{route('categories.delete')}}" method="post">
                    @method('delete')
                    @csrf
                    <input type="hidden" name="categoryId" id="categoryId" value="">
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
    $('.categoryDeleteLink').click(function () {
        var categoryId = $(this).attr('data-id');
        $("#categoryId").attr("value", categoryId);
    });
});
  </script>

@endsection
</x-admin-master>