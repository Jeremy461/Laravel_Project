<?php
namespace App\Http\Controllers;

use App\Post;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function create(Request $request, $song_id)
    {
        $body = $request['body'];
        $user_id = Auth::user()->id;
        DB::table('posts')->insert(['body' => $body, 'song_id' => $song_id, 'user_id' => $user_id]);

        return redirect()->route('dashboard');
    }

    public function deleteComment($post_id)
    {
        $post = Post::where('id', $post_id)->first();
        if(Auth::user() != $post->user){
            return redirect()->back();
        }
        $post->delete();
        return redirect()->back()->with(['message', 'Post successfully deleted!']);
    }
}
