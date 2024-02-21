<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\TestAnswer;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    //

    public function index() {
        $Users = User::where('role', '>', 1)->where('test_taken', 1)->get();
        return view('reviews.index', array(
            'Users' => $Users
        ));

    }

    public function review_user(Request $request, $id) {
        $User = User::find($id);
        $Answers = DB::table('test_answers')
            ->join('tests', 'tests.id', '=', 'test_answers.question_id')
            ->where('test_answers.user_id', $id)
            ->select('test_answers.*', 'tests.question as question', 'tests.title as qTitle')
            ->get();
         return view('reviews.review', array(
            'User' => $User,
            'Answers' => $Answers
        ));

    }
    public function accept(Request $request, $id) {
        $User = User::find($id);
        $User->test_taken = 2;
        $User->save();
        return redirect("/reviews");


    }
    public function refuse(Request $request, $id) {
        $User = User::find($id);
        $User->test_taken = 0;
        $User->save();
        TestAnswer::where('user_id', $id)->delete();
        return redirect("/reviews");
    }
}
