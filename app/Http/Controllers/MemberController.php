<?php

namespace App\Http\Controllers;

use App\Models\Club;
use App\Models\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MemberController extends Controller
{
    //
    public function create(Request $request)
    {
        $student_id = $request->student;
        $club_id = $request->club;
        Log::debug($request);
        DB::table('members')->insert(['student_id' => $student_id, 'club_id' => $club_id]);

        $clubs = Club::all();
        foreach($clubs as $club){
            if(count(Member::where('club_id', $club->id)->get()) >= 5){
                $club->approval = 1;
                $club->save();
            }
        };

        return redirect('/');
    }
}
