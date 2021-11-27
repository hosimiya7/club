<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Student;
use App\Models\Club;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class StudentController extends Controller
{
    //
    public function create(Request $request)
    {
        $name = $request->name;
        Student::insert(['name' => $name]);
        return redirect('/');
    }

    public function show()
    {
        $students = Student::all();
        $clubs = Club::all();
        return view('welcome', ['students' => $students, 'clubs' => $clubs]);
    }

}
