<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\DB;
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

    public function addLike($post_id)
    {
        $post = Post::where('id', $post_id)->first();

        if (DB::table('likes')->where([['user_id', '=', $post->user->id], ['post_id', '=', $post_id]])->count() > 0) {
            return redirect()->route('dashboard')->with(['message' => 'You have already liked this post!']);
        } else {
            if (DB::table('dislikes')->where([['user_id', '=', $post->user->id], ['post_id', '=', $post_id]])->count() > 0) {
                DB::table('dislikes')->where([['user_id', '=', $post->user->id], ['post_id', '=', $post_id]])->delete();
                DB::table('likes')->insert(['user_id' => $post->user->id, 'post_id' => $post_id]);
                return redirect()->route('dashboard')->with(['message' => 'Successfully liked this post!']);
            } else {
                DB::table('likes')->insert(['user_id' => $post->user->id, 'post_id' => $post_id]);
                return redirect()->route('dashboard')->with(['message' => 'Successfully liked this post!']);
            }
        }
    }

    public function addDislike($post_id)
    {
        $post = Post::where('id', $post_id)->first();

        if (DB::table('dislikes')->where([['user_id', '=', $post->user->id], ['post_id', '=', $post_id]])->count() > 0) {
            return redirect()->route('dashboard')->with(['message' => 'You have already disliked this post!']);
        } else {
                if (DB::table('likes')->where([['user_id', '=', $post->user->id], ['post_id', '=', $post_id]])->count() > 0) {
                    DB::table('likes')->where([['user_id', '=', $post->user->id], ['post_id', '=', $post_id]])->delete();
                    DB::table('dislikes')->insert(['user_id' => $post->user->id, 'post_id' => $post_id]);
                    return redirect()->route('dashboard')->with(['message' => 'Successfully disliked this post!']);
                } else {
                    DB::table('dislikes')->insert(['user_id' => $post->user->id, 'post_id' => $post_id]);
                    return redirect()->route('dashboard')->with(['message' => 'Successfully disliked this post!']);
                }
        }
    }
}
