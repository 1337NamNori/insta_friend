<div class="d-flex justify-content-between align-items-center">
    <div class="d-flex align-items-center">
        <a href="{{ route('profiles.show',$post->user->profile) }}" class="text-dark">
            <img src="{{ $post->user->profile->getAvatar() }}"
                 alt="Avatar" class="rounded-circle mr-3"
                 style="width:40px;">
        </a>
        <a href="{{ route('profiles.show',$post->user->profile) }}" class="text-dark">
            <strong>{{ $post->user->username }}</strong>
        </a>
    </div>
    <div class="dropdown">
        <a class="btn btn-clear" href="#" role="button"
           id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
           aria-expanded="false">
            <i class="fas fa-ellipsis-h"></i>
        </a>

        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuLink">
            <a class="dropdown-item" href="#">Share to...</a>
            <a class="dropdown-item" href="#">Copy link</a>
            @can('update',$post)
                <hr class="my-1">
                <a class="dropdown-item" href="{{ route('posts.edit',$post) }}">Edit caption</a>
                <a class="dropdown-item" href="#">Set private</a>
            @endcan
            @can('delete',$post)
                <form action="{{ route('posts.destroy',$post) }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="dropdown-item text-danger">Delete</button>
                </form>
            @endcan
        </div>
    </div>
</div>
