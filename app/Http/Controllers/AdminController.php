<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Song;

class AdminController extends Controller
{
    public function getUsers(){
        if(Auth::user()->role != '1'){
            return redirect()->route('dashboard')->with(['message', 'You dont have permissions for this']);
        }

        $result = DB::table('users')->where('role', 'like', '0')->get();
        return view('users', ['results' => $result]);
    }

    public function deleteUser($user_id){
        if(Auth::user()->role != '1'){
            return redirect()->route('dashboard')->with(['message', 'You dont have permissions for this']);
        }

        $user = User::where('id', $user_id)->first();
        $user->delete();

        $songs = Song::where('user_id', $user_id);
        $songs->delete();
        return redirect()->back()->with(['message', 'User successfully deleted!']);
    }
}
