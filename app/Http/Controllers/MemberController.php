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
        Member::insert(['student_id' => $student_id, 'club_id' => $club_id]);

        // 部員が5人以上になったら承認状態を未承認にする
        $clubs = Club::all();
        foreach ($clubs as $club) {
            if (count(Member::where('club_id', $club->id)->get()) >= 5) {
                $club->approval = Club::UNAPPROVED;
                $club->save();
            }
        };

        return redirect('/');
    }

    public function delete(Request $request)
    {
        Member::where('student_id', $request->student_id)
            ->where('club_id', $request->club_id)
            ->delete();

        // 上から呼び出せたらいいな
        $members = Member::where('club_id', $request->club_id)->get();
        // もし部員が5人未満になったら、承認状態を人数不足にする。
        if (count($members) < 5) {
            $members[0]->club->approval = Club::INSUFFICIENT;
            $members[0]->club->save();
        }

        return redirect('/');
    }
}
