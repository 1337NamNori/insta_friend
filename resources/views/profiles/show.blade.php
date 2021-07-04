@extends('layouts.app')

@section('content')
    <div class="container p-0">
        <div class="row p-3 d-none d-md-flex">
            <div class="col col-4 d-flex justify-content-center align-items-center">
                <img src="/images/avatar.jpg" class="rounded-circle w-75" alt="Profile Avatar">
            </div>
            <div class="col col-8 d-flex flex-column justify-content-center ">
                <div class="d-flex align-items-center mb-2">
                    <h3 class="mb-0 mr-3">{{ $profile->user->username }}</h3>
                    <a href="{{ route('profiles.edit',Auth::user()->id) }}"
                       class="btn btn-sm btn-outline-secondary">Edit
                        profile</a>
                </div>

                <div class="row mt-2">
                    <div class="col col-lg-6 col-sm-12 d-flex justify-content-between">
                        <p><strong>9 </strong>posts</p>
                        <p><strong>538 </strong>followers</p>
                        <p><strong>73 </strong>following</p>
                    </div>
                </div>

                <strong>{{ $profile->name }}</strong>
                <p class="mb-0">{{ $profile->description }}</p>
                <a href="{{ $profile->url }}">{{ $profile->url }}</a>


            </div>
        </div>
        <div class="row no-gutters d-sm-block d-md-none">
            <div class="col col-4 p-3 d-flex justify-content-start align-items-start">
                <img src="/images/avatar.jpg" class="rounded-circle w-100" alt="Profile Avatar">
            </div>
            <div class="col col-8 p-3 d-flex flex-column justify-content-center">
                    <h3 class="p-0">{{ $profile->user->username }}</h3>
                    <a href="{{ route('profiles.edit',Auth::user()->id) }}"
                       class="btn btn-sm btn-outline-secondary w-100">Edit
                        profile</a>
            </div>
            <div class="col col-12 p-3">
                <strong>{{ $profile->name }}</strong>
                <p class="mb-0">{{ $profile->description }}</p>
                <a href="{{ $profile->url }}" class="text-truncate" style="max-width:150px;">{{ $profile->url }}</a>
            </div>
            <div class="col col-12 mb-2 mt-3" style="height:1px;width:100%;background-color:#bbbbbb;"></div>
            <div class="col col-12 mt-2 d-flex justify-content-center">
                <div class="row w-100">
                    <div class="col col-4 d-flex flex-column align-items-center">
                        <strong>9 </strong>
                        <p>posts</p>
                    </div>
                    <div class="col col-4 d-flex flex-column align-items-center">
                        <strong>583 </strong>
                        <p>followers</p>
                    </div>
                    <div class="col col-4 d-flex flex-column align-items-center">
                        <strong>73 </strong>
                        <p>following</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row no-gutters">
            @for($i=0;$i<9;$i++)
                <div class="col col-4 mt-md-3 px-md-2">
                    <img src="/images/avatar.jpg" alt="Post" class="w-100">
                </div>
            @endfor
        </div>
    </div>
@endsection
