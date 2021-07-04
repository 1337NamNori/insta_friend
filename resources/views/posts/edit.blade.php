@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Edit image's caption</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('posts.update',$post) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group row">
                                <label for="caption"
                                       class="col-md-4 col-form-label text-md-right">{{ __('Caption') }}</label>

                                <div class="col-md-6">
                                    <textarea id="caption"
                                              class="form-control" name="caption"
                                              autocomplete="caption"
                                              autofocus>{{ $post->caption}}</textarea>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Save changes') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
