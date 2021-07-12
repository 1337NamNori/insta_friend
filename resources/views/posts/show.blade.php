@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="card mt-3">
            <div class="row no-gutters">
                {{--                Header for mobile--}}
                <div class="col col-12 ">
                    <div class="card-body d-sm-block d-lg-none">
                        @include('posts.post-header')
                    </div>
                </div>
                {{--       End Header for mobile--}}
                {{--Image--}}
                <div class="col col-lg-8 col-12">
                    <img src="{{ $post->image }}" alt="Post" class="card-img border-radius-0">
                </div>
                {{-- End Image--}}
                <div class="col col-lg-4 col-sm-0 ">
                    {{--Header for PC--}}
                    <div class="card-body d-none d-lg-block">
                        @include('posts.post-header')
                    </div>
                    {{-- End header for PC--}}
                    <hr class="m-0">
                    {{--Caption and comment--}}
                    <div class="card-body">
                        <like
                            like="{{Auth::user() ? Auth::user()->likedPosts->contains($post->id):false }}"
                            count="{{ $post->likedUser->count() }}"
                            id="{{ $post->id }}"
                        >
                        </like>
                        <br>
                        @if($post->caption)
                            <div class="d-flex">
                                <a href="{{ route('profiles.show',$post->user->profile) }}">
                                    <img src="{{ $post->user->profile->getAvatar() }}"
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
                        @endif
                    </div>
                    {{--End Caption and comment--}}
                </div>
            </div>
        </div>
    </div>
@endsection
