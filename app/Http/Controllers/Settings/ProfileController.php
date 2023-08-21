<?php

namespace App\Http\Controllers\Settings;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }
    public function edit()
    {
        return view('settings.edit', ['user' => auth()->user()]);
    }

    public function update(ProfileRequest $request)
    {
        $profileData = $request->handlePictureRequest();

        $request->user()->update($profileData);

        return back()->with('message', 'Profile updated successfully!');
    }
}
