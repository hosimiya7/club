<?php

namespace App\Http\Controllers;

use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class ClubController extends Controller
{
    //
    public function create(Request $request)
    {
        $name = $request->club;
        Club::insert(['name' => $name]);
        return redirect('/');
    }

    public function approval(Request $request)
    {
        $club = Club::where('id', $request->club_id)->first();
        $club->approval = 2;
        $club->save();

        return redirect('/');
    }
}
