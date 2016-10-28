<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Post;
use App\User;

class ProfileController extends Controller
{
    public function editProfile(){
        return view('edit_profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request){
        $this->validate($request, [
            'name' => 'required|max:120'
        ]);

        $user = Auth::user();
        $user->name = $request['name'];
        $user->update();

        $file = $request->file('image');
        $filename = $request['name'] . '-' . $user->id . '.jpg';
        if($file){
            Storage::disk('local')->put($filename, File::get($file));
        }
        return redirect()->route('profile');
    }

    public function getProfileImage($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    public function getProfile($userid){
        $songs = Song::orderBy('created_at', 'desc')->get();
        $user = User::where('id', $userid)->first();
        if(!$user){
            abort(404);
        }
        return view('profile', ['songs' => $songs])->with('user', $user);
    }
}
