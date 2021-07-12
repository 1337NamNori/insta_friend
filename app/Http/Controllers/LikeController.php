<?php

namespace App\Http\Controllers;

use App\Models\Post;

class LikeController extends Controller
{
    public function store(Post $post)
    {
        return auth()->user()->likedPosts()->toggle($post);
    }
}
