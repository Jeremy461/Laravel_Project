<?php
namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostController extends Controller
{



    public function create(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $post = new Post();
        $post->body = $request['body'];
        $message = 'There was an error, post is not created';
        if ($request->user()->posts()->save($post)) {
            $message = 'Post successfully created!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }

    public function getDashboard()
    {
        $posts = Post::orderBy('created_at', 'desc')->get();
        return view('home', ['posts' => $posts]);
    }

    public function deletePost($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if(Auth::user() != $post->user){
            return redirect()->back();
        }
        $post->delete();
        return redirect()->back()->with(['message', 'Post successfully deleted!']);
    }
}
