@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col col-lg-7 col-12">
                <img src="/storage/{{ $post->image }}" alt="Post" class="w-100">
            </div>
            <div class="col col-lg-5 col-12">
                <div class="bg-light">
                    <strong>
                        {{ $post->user->username }}
                    </strong>
                    {{$post->caption}}
                    <div class="dropdown">
                        <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenuButton"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="{{ route('posts.edit',$post) }}">Edit Caption</a>
                            <a class="dropdown-item" href="#">Set Private</a>
                            <form action="{{route('posts.destroy',$post)}}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button class="dropdown-item" type="submit">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
