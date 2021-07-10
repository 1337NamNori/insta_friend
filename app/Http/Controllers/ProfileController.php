<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    public function index()
    {
        $users = auth()->user()->following()->pluck('profiles.user_id');
        $profiles = Profile::whereNotIn('user_id', $users)->latest()->get();
        return view('profiles.index', compact('profiles'));
    }

    public function show(Profile $profile)
    {
        $follow = auth()->user() ? auth()->user()->following->contains($profile->id) : false;
        return view('profiles.show', compact('profile', 'follow'));
    }

    public function edit(Profile $profile)
    {
        $this->authorize('update', $profile);
        return view('profiles.edit', compact('profile'));
    }

    public function update(Profile $profile)
    {
        $this->authorize('update', $profile);
        $data = request()->validate([
            'name' => 'required',
            'description' => '',
            'url' => 'nullable|URL',
            'avatar' => 'sometimes|file|image|max:1000'
        ]);
        if (request()->has('avatar')) {
            if ($profile->avatar && is_file(public_path($profile->avatar))) {
                unlink(public_path($profile->avatar));
            }
        }
        $profile->update($data);
        $this->storeImage($profile);
        return redirect(route('profiles.show', $profile));
    }

    protected function storeImage($profile)
    {
        if (request()->has('avatar')) {
            $image = request()->file('avatar');
            $path = '/images/avatars/' . Str::random(8) . '-' . $image->getClientOriginalName();
            Image::make($image)->fit(300, 300)->save(public_path($path));
            $profile->update([
                'avatar' => $path
            ]);
        }
    }

}
