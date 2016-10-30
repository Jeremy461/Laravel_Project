<?php

namespace App\Http\Controllers;

use App\Post;
use App\Song;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */

    //$result = DB::table('users')->where('name', 'like', '%' . $input . '%')->get();

    public function index()
    {
        $uploadCount = DB::table('songs')->where('user_id', 'like', Auth::user()->id)->count();
        $posts = Post::all();
        $songs = Song::all();
        return view('home', ['posts' => $posts, 'songs' => $songs, 'uploadCount' => $uploadCount]);
    }
}
