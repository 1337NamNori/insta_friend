@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col col-md-8 col-12">
                @forelse($posts as $post)
                    <div class="card mt-3">
                        <div class="row">
                            <div class="col col-12">
                                <div class="card-body">
                                    @include('posts.post-header')
                                </div>
                            </div>
                            {{--Image--}}
                            <div class="col col-12">
                                <img src="{{ $post->image }}" alt="Post" class="card-img border-radius-0">
                            </div>
                            {{-- End Image--}}
                            {{--Caption and comment--}}
                            <div class="col col-12">
                                <div class="card-body">
                                    <like
                                        like="{{Auth::user() ? Auth::user()->likedPosts->contains($post->id):false }}"
                                        count="{{ $post->likedUser->count() }}"
                                        id="{{ $post->id }}"
                                    >
                                    </like>
                                    @if($post->caption)
                                        <div class="d-flex">
                                            <div>
                                                <a href="{{ route('profiles.show',$post->user->profile) }}"
                                                   class="text-dark">
                                                    <strong>{{ $post->user->username }}</strong>
                                                </a>
                                                {{ $post->caption }}
                                                <br>
                                                <a href="{{ route('posts.show',$post) }}"
                                                   class="text-decoration-none text-uppercase">
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                    <a href="{{ route('posts.show',$post) }}"
                                       class="text-decoration-none">
                                        <small
                                            class="text-muted text-uppercase">{{ $post->created_at->diffForHumans() }}</small>
                                    </a>
                                </div>
                            </div>
                            {{--End Caption and comment--}}
                        </div>
                    </div>
                @empty
                    <div class="d-flex justify-content-center">
                        <p>
                            There is no post. <a href="{{ route('posts.create') }}">Post</a> or follow people to see
                            many posts
                        </p>
                    </div>
                @endforelse
            </div>
            <div class="col col-md-4 d-none d-sm-block mt-4">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center">
                        <a href="{{ route('profiles.show',Auth::user()->profile) }}">
                            <img src="{{ Auth::user()->profile->getAvatar() }}"
                                 alt="Avatar" class="rounded-circle mr-3"
                                 style="width:55px;height:55px;">
                        </a>
                        <div class="d-flex flex-column">
                            <a href="{{ route('profiles.show',Auth::user()->profile) }}"
                               class="text-dark text-decoration-none">
                                <strong class="font-size-14 p-0">{{ Auth::user()->username }}</strong>
                            </a>
                            <small class="text-muted font-size-14">{{ Auth::user()->profile->name }}</small>
                        </div>
                    </div>
                    <div>
                        <a href="#" class="btn btn-link btn-no-outline text-decoration-none p-0">
                            <small class="font-weight-bold">Switch</small>
                        </a>
                    </div>
                </div>
                @if($profiles->count()>0)
                    <div class="d-flex justify-content-between align-items-center mt-4 mb-3">
                        <p class="text-muted m-0 font-size-14 font-weight-bold">Suggestions For You</p>
                        <a href="{{ route('suggest') }}"
                           class="text-decoration-none font-size-12 text-dark font-weight-bold">See all</a>
                    </div>
                @endif
                <div>
                    @foreach($profiles as $profile)
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <div class="d-flex align-items-center">
                                <a href="{{ route('profiles.show',$profile) }}">
                                    <img src="{{ $profile->getAvatar() }}"
                                         alt="Avatar" class="rounded-circle mr-3"
                                         style="width:40px;height:40px;">
                                </a>
                                <div class="d-flex flex-column">
                                    <a href="{{ route('profiles.show',$profile) }}"
                                       class="text-dark text-decoration-none p-0">
                                        <strong class="font-size-14 p-0">{{ $profile->username }}</strong>
                                    </a>
                                    <small class="text-muted font-size-12">{{ $profile->name }}</small>
                                </div>
                            </div>
                            <div>
                                <follow-btn username="{{  $profile->username }}" follow=""
                                            display="home"></follow-btn>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection
