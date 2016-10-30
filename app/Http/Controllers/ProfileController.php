<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use App\Post;
use App\User;
use Illuminate\Support\MessageBag;
use Illuminate\View\Middleware\ShareErrorsFromSession;

class ProfileController extends Controller
{
    public function editProfile(){
        return view('edit_profile', ['user' => Auth::user()]);
    }

    public function updateProfile(Request $request){
        $this->validate($request, [
            'name' => 'required|max:120|alpha',
            'email' => 'required|max:120'
        ]);

        $user = Auth::user();
        $user->name = $request['name'];
        $user->update();

        $file = $request->file('image');
        $filename = $request['name'] . '-' . $user->id . '.jpg';
        if($file){
            Storage::disk('local')->put($filename, File::get($file));
        }
        return view('edit_profile', ['user' => Auth::user()])->with('message', 'Account updated!');
    }

    public function getProfileImage($filename){
        $file = Storage::disk('local')->get($filename);
        return new Response($file, 200);
    }

    public function getProfile($userid){
        $posts = Post::orderBy('created_at', 'desc')->get();
        $songs = Song::orderBy('created_at', 'desc')->get();
        $user = User::where('id', $userid)->first();
        $uploadCount = DB::table('songs')->where('user_id', 'like', Auth::user()->id)->count();
        if(!$user){
            abort(404);
        }
        return view('profile', ['songs' => $songs, 'posts' => $posts, 'uploadCount' => $uploadCount])->with('user', $user);
    }
}
