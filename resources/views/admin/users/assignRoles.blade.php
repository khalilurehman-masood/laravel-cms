<x-admin-master>
@section('content')
<h1>User Roles ({{$user->name}})</h1>
<hr>
<div class="row">
<div class="col-sm-6">
@if(count($userRoles)==null)
<h1>There are no roles assigned to this user yet.</h1>
@else
<h2>Current roles:</h2>
<ul>
    @foreach($userRoles as $userRole)
    <li>{{$userRole->name}}</li>
    @endforeach
</ul>

<form method="POST" action="{{route('user.detachRoles',$user->id)}}"  class="col-md-8">
@csrf
@method('Patch')
<div class="form-group">
@foreach($userRoles as $userRole)
    <div class="form-check">
    <input class="form-check-input" type="checkbox" value="{{$userRole->id}}" id="detachRolesCheckBox" name="detachRoles[]">
    <label class="form-check-label" for="detachRolesCheckBox">{{$userRole->name}}</label>
    </div>
@endforeach
</div>
<div class="form-group">
   <input type="submit" class="btn btn-danger btn-sm" name="removeRoles" value="Remove Roles">
</div>

</form>
@endif

</div>

<div class="col-sm-6">
    
@if(count($userRoles) == count($totalRoles))
<p>No remaining roles to be assigned to the User.</p>

@else

<form method="POST" action="{{route('user.attachRoles',$user->id)}}"  class="col-md-8">
@csrf
@method('Patch')
<div class="form-group">
    
    @foreach($totalRoles as $singleRole)
    @php $matchFlag=false @endphp
       @foreach($userRoles as $singleUserRole)
        @if($singleRole->slug == $singleUserRole->slug)
        @php $matchFlag=true @endphp
        @break
        @endif
        @endforeach
        @if($matchFlag==false)
        <div class="form-check">
        <input class="form-check-input" type="checkbox" value="{{$singleRole->id}}" id="rolesCheckBox" name="roles[]">
        <label class="form-check-label" for="rolesCheckBox">{{$singleRole->name}}</label>
        </div>
        @endif

    @endforeach

    </div>
<div class="form-group">
   <input type="submit" class="btn btn-primary" name="attachRoles" value="Add Roles">
</div>
</form>

@endif
</div>
</div>

@endsection
</x-admin-master>