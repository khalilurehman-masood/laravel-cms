
<li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
          <i class="fas fa-fw fa-sticky-note"></i>
          <span>My Posts</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
          <div class="bg-white py-2 collapse-inner rounded">
            <a class="collapse-item" href="{{route('post.createNew')}}">Create New Post</a>
            <a class="collapse-item" href="{{route('posts.all')}}">View My Posts</a>
          </div>
        </div>
      </li>