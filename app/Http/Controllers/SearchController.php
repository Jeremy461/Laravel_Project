<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\User;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    public function searchUser(Request $request)
    {
        $this->validate($request, [
            'search_user' => 'required'
        ]);

        $input = $request['search_user'];

        $result_type = 'user';
        $result = DB::table('users')->where('name', 'like', '%' . $input . '%')->get();
        return view('search_results', ['results' => $result, 'result_type' => $result_type ]);
    }

    public function searchSong(Request $request)
    {
        $this->validate($request, [
            'search_song' => 'required'
        ]);

        $input = $request['search_song'];

        $result_type = 'song';
        $result = DB::table('songs')->where('title', 'like', '%' . $input . '%')->orwhere('genre', 'like', '%' . $input . '%')->get();
        return view('search_results', ['results' => $result, 'result_type' => $result_type ]);
    }
}
