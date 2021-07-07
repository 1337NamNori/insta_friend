<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function __construct(){
        $this->middleware('auth')->except('show');
    }
    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => '',
            'image' => 'required|file|image|max:1000',
        ]);

        $image = request()->file('image');
        $path = '/images/posts/' . Str::random(8) . '-' . $image->getClientOriginalName();
        Image::make($image)->fit(1200, 1200)->save(public_path($path));

        $post = auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $path,
        ]);
        return redirect(route('profiles.show', $post->user->profile));
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        $this->authorize('update',$post);
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $this->authorize('update',$post);
        $post->update([
            'caption' => request('caption')
        ]);
        return redirect(route('posts.show', $post->id));
    }

    public function destroy(Post $post)
    {
        $this->authorize('delete',$post);
        File::delete(public_path($post->image));
        $post->delete();
        return redirect(route('profiles.show', $post->user->profile));

    }
}
