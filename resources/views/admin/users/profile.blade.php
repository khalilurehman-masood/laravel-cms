<x-admin-master>
          
          @section('content')

          @if(Session::has('userUpdateMessage'))
          <div class="alert alert-success">
          {{session::get('userUpdateMessage')}}
          </div>
          @endif
          <h2 class="text-center">Your Profile</h2>
          <div class="container emp-profile">
            <form method="post">
                <div class="row">
                    <div class="col-md-4">
                        <div class="profile-img">
                            <img  width="200px" src="{{$user->avatar}}" alt=""/>
                            
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="profile-head">
                                    <h5>
                                        {{$user->name}}
                                    </h5>
                                    <h6>
                                        {{$user->profession}}
                                    </h6>
                                    <p class="proile-rating">RANKINGS : <span>8/10</span></p>
                            <ul class="nav nav-tabs" id="myTab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home" role="tab" aria-controls="home" aria-selected="true">About</a>
                                </li>
                               
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-2">
                        @can('update',$user)
                        <a href="{{route('user.profile.edit')}}" class="btn btn-secondary" name="editProfile">Edit Profile</a>
                        @endcan
                        @can('assignRoles',$user)
                        <a href="{{route('users.profile.assignRoles',$user->id)}}" class="btn btn-primary mt-1 btn-sm" name="assignRoles">Manage Roles</a>
                        @endcan
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4 mt-2">
                              <h3 class="text-center">Brief Intro.</h3>
                              <p class="text-justify">
                                        Lorem ipsum dolor sit amet consectetur, adipisicing elit. 
                                        Possimus provident nulla eaque omnis, repellat eum! Itaque architecto ratione dicta
                                         earum rem! Iure unde, deserunt rem pariatur dolorum maiores maxime neque.
                              </p>
                    </div>
                  <div class="col-md-8">
                        <div class="tab-content profile-tab" id="myTabContent">
                            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>User Id</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->id}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Name</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->name}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Email</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->email}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Phone</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->contact}}</p>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <label>Profession</label>
                                            </div>
                                            <div class="col-md-6">
                                                <p>{{$user->profession}}</p>
                                            </div>
                                        </div>
                            </div>
            
                        </div>
                    </div>
                </div>
            </form>           
        </div>
          @endsection
</x-admin-master>