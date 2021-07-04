<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class PostController extends Controller
{
    public function create()
    {
        return view('posts.create');
    }

    public function store()
    {
        $data = request()->validate([
            'caption' => '',
            'image' => 'required|file|image|max:5000',
        ]);

        $imagePath = request('image')->store('uploads', 'public');
        $image = Image::make(public_path('storage/' . $imagePath))->fit(1200, 1200);
        $image->save();


        auth()->user()->posts()->create([
            'caption' => $data['caption'],
            'image' => $imagePath,
        ]);
        return redirect('/profiles/' . auth()->user()->id);
    }

    public function show(Post $post)
    {
        return view('posts.show', compact('post'));
    }

    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));
    }

    public function update(Post $post)
    {
        $post->update([
            'caption' => request('caption')
        ]);
        return redirect(route('posts.show', $post->id));
    }

    public function destroy(Post $post)
    {
        File::delete(public_path('storage/' . $post->image));
        $post->delete();
        return redirect('/profiles/' . auth()->user()->id);

    }
}
