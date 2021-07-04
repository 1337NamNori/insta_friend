<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show(Profile $profile)
    {
        $posts = $profile->user->posts;
        return view('profiles.show', compact('profile', 'posts'));
    }

    public function edit(Profile $profile)
    {
        return view('profiles.edit', compact('profile'));
    }

    public function update(Profile $profile)
    {
        $profile->update($this->validatedData());
        return redirect(route('profiles.show', $profile->id));
    }

    protected function validatedData()
    {
        return request()->validate([
            'name' => 'required',
            'description' => '',
            'url' => 'nullable|URL'
        ]);
    }

}
