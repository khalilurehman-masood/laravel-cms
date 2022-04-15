<x-admin-master>
@section('content')
<h1> profile edit view</h1>
<form method="POST" action="{{route('user.update')}}" enctype="multipart/form-data"  class="col-md-8">
@csrf
@method('Patch')
<div class="form-group">
    <label for="title">Name</label>
    <input type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{$user->name}}">
</div>

@error('name')
<div class="invalid feedback">{{$message}}</div>
@enderror
<div class="form-group">
    <label for="email">Email</label>
    <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{$user->email}}">
</div>
@error('email')
<div class="invalid feedback">{{$message}}</div>
@enderror
<div class="form-group">
   <input type="submit" class="btn btn-primary" name="editPost">
</div>

  
</form>
          @endsection
</x-admin-master>