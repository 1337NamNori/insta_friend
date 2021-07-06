@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-3">
            <div class="row no-gutters">
                <div class="col col-lg-8 col-12">
                    <img src="{{ $post->image }}" alt="Post" class="card-img">
                </div>
                <div class="col col-lg-4 col-12">
                    <div class="card-body">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('profiles.show',$post->user->profile) }}" class="text-dark">
                                    <img src="{{ $post->user->profile->avatar ?? '/images/temp/default.webp' }}"
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
                                    <a class="dropdown-item" href="{{ route('posts.edit',$post) }}">Edit caption</a>
                                    <a class="dropdown-item" href="#">Set private</a>
                                    <hr class="my-1">
                                    <form action="{{ route('posts.destroy',$post) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="dropdown-item">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="m-0">
                    <div class="card-body">
                        <div class="d-flex">
                            <a href="{{ route('profiles.show',$post->user->profile) }}">
                                <img src="{{ $post->user->profile->avatar ?? '/images/temp/default.webp' }}"
                                     alt="Avatar" class="rounded-circle mr-3"
                                     style="width:40px;height:40px;">
                            </a>
                            <div>
                                <a href="{{ route('profiles.show',$post->user->profile) }}" class="text-dark">
                                    <strong>{{ $post->user->username }}</strong>
                                </a>
                                {{ $post->caption }}
                                <br>
                                <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
