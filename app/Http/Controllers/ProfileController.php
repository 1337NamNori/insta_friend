<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

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
        $data = request()->validate([
            'name' => 'required',
            'description' => '',
            'url' => 'nullable|URL',
            'avatar' => 'sometimes|file|image|max:5000'
        ]);
        if (request()->has('avatar')) {
            if ($profile->avatar && is_file(public_path('storage/' . $profile->avatar))) {
                unlink(public_path('storage/' . $profile->avatar));
            }
        }
        $profile->update($data);
        $this->storeImage($profile);
        return redirect(route('profiles.show', $profile->id));
    }

    protected function storeImage($profile)
    {
        if (request()->has('avatar')) {
            $imagePath = request('avatar')->store('avatars', 'public');
            $image = Image::make(public_path('storage/' . $imagePath))->fit(300, 300);
            $image->save();
            $profile->update([
                'avatar' => $imagePath
            ]);
        }
    }

}
