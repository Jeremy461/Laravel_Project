<?php

namespace App\Http\Controllers;

use App\Song;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;

class SongController extends Controller
{
//    public function upload(Request $request)
//    {
//        $user = Auth::user();
//
//        $file = $request->file('song');
//        $title = $request['title'];
//        $filename = Auth::user()->name . '-' . $user->id . '.mp3';
//
//        if ($file) {
//            Storage::disk('local')->put($filename, File::get($file));
//        }
//        return redirect()->route('dashboard')->with(['message', 'Song successfully uploaded!']);
//    }

    public function upload(Request $request)
    {
        $file = $request->file('song');
        $title = $request['title'];
        $filename = Auth::user()->name . "-" . $request['title'] . ".mp3";
        $user_id = Auth::user()->id;

        DB::table('songs')->insert(['title' => $title, 'path' => $filename, 'user_id' => $user_id]);

        Storage::disk('local')->put($filename, File::get($file));
        return redirect()->back()->with(['message', 'Post successfully deleted!']);
    }

    public function getSong($path){
        $file = Storage::disk('local')->get($path);
        return new Response($file, 200);
    }
}
