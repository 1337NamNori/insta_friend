@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col col-lg-8 col-12 mt-3">
                <p class="font-weight-bold px-3">Suggested</p>
                <div class="card border-0">
                    <div class="card-body">
                        @forelse($profiles as $profile)
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
                                                display="pc"></follow-btn>
                                </div>
                            </div>
                        @empty
                            There is no people to follow.
                            <a href="{{ route('home') }}">Go back</a>
                        @endforelse

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
