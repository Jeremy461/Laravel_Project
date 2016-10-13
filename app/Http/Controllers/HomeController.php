<?php

namespace App\Http\Controllers;

use App\Post;
use App\Song;
use Illuminate\Http\Request;

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
    public function index()
    {
        $posts = Post::all();
        $songs = Song::all();
        return view('home', ['posts' => $posts, 'songs' => $songs]);
    }
}
