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
        $newGenre = $request['genre'];
        $filename = Auth::user()->name . "-" . $request['title'] . ".mp3";
        $user_id = Auth::user()->id;
        $genre = DB::table('genres')->where('name', 'like', $newGenre)->get()->first();
        if($file){
            if($genre != null){
                DB::table('songs')->insert(['title' => $title, 'path' => $filename, 'user_id' => $user_id, 'genre_id' => $genre->id]);
            } else {
                DB::table('genres')->insert(['name' => $newGenre]);
                $genre = DB::table('genres')->where('name', 'like', $newGenre)->get()->first();
                DB::table('songs')->insert(['title' => $title, 'path' => $filename, 'user_id' => $user_id, 'genre_id' => $genre->id]);
            }
            Storage::disk('local')->put($filename, File::get($file));
            return redirect()->route('dashboard')->with(['message', 'Song successfully uploaded!']);
        } else {
            dd("File not uploaded");
        }

    }

    public function getSong($path){
        $file = Storage::disk('local')->get($path);
        return new Response($file, 200);
    }

    public function addLike($song_id)
    {
        $song = Song::where('id', $song_id)->first();

        if (DB::table('likes')->where([['user_id', '=', $song->user->id], ['song_id', '=', $song_id]])->count() > 0) {
            return redirect()->route('dashboard')->with(['message' => 'You have already liked this song!']);
        } else {
            if (DB::table('dislikes')->where([['user_id', '=', $song->user->id], ['song_id', '=', $song_id]])->count() > 0) {
                DB::table('dislikes')->where([['user_id', '=', $song->user->id], ['song_id', '=', $song_id]])->delete();
                DB::table('likes')->insert(['user_id' => $song->user->id, 'song_id' => $song_id]);
                return redirect()->route('dashboard')->with(['message' => 'Successfully liked this song!']);
            } else {
                DB::table('likes')->insert(['user_id' => $song->user->id, 'song_id' => $song_id]);
                return redirect()->route('dashboard')->with(['message' => 'Successfully liked this song!']);
            }
        }
    }

    public function addDislike($song_id)
    {
        $song = Song::where('id', $song_id)->first();

        if (DB::table('dislikes')->where([['user_id', '=', $song->user->id], ['song_id', '=', $song_id]])->count() > 0) {
            return redirect()->route('dashboard')->with(['message' => 'You have already disliked this song!']);
        } else {
            if (DB::table('likes')->where([['user_id', '=', $song->user->id], ['song_id', '=', $song_id]])->count() > 0) {
                DB::table('likes')->where([['user_id', '=', $song->user->id], ['song_id', '=', $song_id]])->delete();
                DB::table('dislikes')->insert(['user_id' => $song->user->id, 'song_id' => $song_id]);
                return redirect()->route('dashboard')->with(['message' => 'Successfully disliked this song!']);
            } else {
                DB::table('dislikes')->insert(['user_id' => $song->user->id, 'song_id' => $song_id]);
                return redirect()->route('dashboard')->with(['message' => 'Successfully disliked this song!']);
            }
        }
    }

    public function deleteSong($song_id)
    {
        $song = Song::where('id', $song_id)->first();
        if(Auth::user() != $song->user){
            return redirect()->back();
        }
        $song->delete();
        return redirect()->back()->with(['message', 'Song successfully deleted!']);
    }

    public function getDashboard()
    {
        $songs = Song::all();
        return view('home', ['songs' => $songs]);
    }
}
