<x-admin-master>
@section('content')
<h1>permissions</h1>

<ul>
@foreach($permissions as $permission)
<li>{{$permission->name}}</li>
@endforeach
</ul>

@endsection
</x-admin-master>