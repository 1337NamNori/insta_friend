@extends('layouts.app')

@section('content')
    <div class="container p-0">
        {{--        Header for PC--}}
        <div class="row p-3 d-none d-md-flex">
            {{--            Avatar--}}
            <div class="col col-4 d-flex justify-content-center align-items-center">
                <img src="{{ $profile->getAvatar() }}" class="rounded-circle w-75"
                     alt="Profile Avatar">
            </div>
            {{--            Info--}}
            <div class="col col-8 d-flex flex-column justify-content-center ">
                <div class="d-flex align-items-center mb-2">
                    <h3 class="mb-0 mr-3">{{ $profile->user->username }}</h3>
                    @can('update', $profile)
                        <a href="{{ route('profiles.edit',Auth::user()->profile) }}"
                           class="btn btn-sm btn-outline-black btn-no-outline font-weight-bold font-size-14">Edit
                            profile</a>
                    @else
                        <follow-btn username="{{  $profile->user->username }}" follow="{{ $follow }}"
                                    display="pc"></follow-btn>
                    @endcan
                </div>

                <div class="row mt-2">
                    <div class="col col-lg-6 col-sm-12 d-flex justify-content-between">
                        <p><strong>{{ $profile->user->posts->count() }} </strong>posts</p>
                        <p><strong>{{ $profile->followers->count() - 1}} </strong>followers</p>
                        <p><strong>{{ $profile->user->following->count() - 1 }} </strong>following</p>
                    </div>
                </div>

                <strong>{{ $profile->name }}</strong>
                <p class="mb-0">{{ $profile->description }}</p>
                <a href="{{ $profile->url }}">{{ $profile->url }}</a>
            </div>
        </div>
        {{--        End Header for PC--}}
        {{--        Header for mobile--}}
        <div class="row no-gutters d-sm-block d-md-none">
            {{--            Avatar--}}
            <div class="col col-4 p-3 d-flex justify-content-start align-items-start">
                <img src="{{ $profile->getAvatar() }}" class="rounded-circle w-100"
                     alt="Profile Avatar">
            </div>
            {{--            Name and Edit Btn--}}
            <div class="col col-8 p-3 d-flex flex-column justify-content-center">
                <h3 class="p-0">{{ $profile->user->username }}</h3>
                @can('update', $profile)
                    <a href="{{ route('profiles.edit',Auth::user()->profile) }}"
                       class="btn btn-sm btn-outline-black btn-no-outline w-100 font-weight-bold font-size-14">Edit
                        profile</a>
                @else
                    <follow-btn username="{{  $profile->user->username }}" follow="{{ $follow }}"
                                display="mobile"></follow-btn>
                @endcan
            </div>
            {{--            Info--}}
            <div class=" col col-12 p-3">
                <strong>{{ $profile->name }}</strong>
                <p class="mb-0">{{ $profile->description }}</p>
                <a href="{{ $profile->url }}" class="text-truncate" style="max-width:150px;">{{ $profile->url }}</a>
            </div>
            <div class="col col-12 mb-2 mt-3" style="height:1px;width:100%;background-color:#bbbbbb;"></div>
            {{--            Number of Posts, Followers, Following--}}
            <div class="col col-12 mt-2 d-flex justify-content-center">
                <div class="row w-100">
                    <div class="col col-4 d-flex flex-column align-items-center">
                        <strong>{{ $profile->user->posts->count() }} </strong>
                        <p>posts</p>
                    </div>
                    <div class="col col-4 d-flex flex-column align-items-center">
                        <strong>{{ $profile->followers->count() - 1}} </strong>
                        <p>followers</p>
                    </div>
                    <div class="col col-4 d-flex flex-column align-items-center">
                        <strong>{{ $profile->user->following->count() - 1}} </strong>
                        <p>following</p>
                    </div>
                </div>
            </div>
        </div>
        {{--        End Header for mobile--}}
        <div class="row no-gutters">
            @forelse($profile->user->posts as $post)
                <div class="col col-4 mt-md-3 px-md-2">
                    <a href="{{ route('posts.show',$post->id) }}">
                        <img src="{{ $post->image }}" alt="Post" class="w-100">
                    </a>
                </div>
            @empty
                @if(Auth::user()->id == $profile->user_id)
                    <div class="col col-8 offset-2 text-center mt-5">
                        <p>
                            There is no post.
                        </p>
                        <a href="{{ route('posts.create') }}" class="btn btn-primary">Add a new Post</a>
                    </div>
                @endif
            @endforelse
        </div>
    </div>
@endsection
