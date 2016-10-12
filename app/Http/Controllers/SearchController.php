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

        $result = DB::table('users')->where('name', 'like', '%' . $input . '%')->get();
        return view('search_results', ['results' => $result]);
    }
}
