<?php

namespace App\Http\Controllers;

use App\Models\Profile;
use Illuminate\Http\Request;

class FollowsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Profile $profile)
    {
        return auth()->user()->following()->toggle($profile);
    }
}
