<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TestAnswer;
use App\Models\User;
use Auth;

class TestAnswerController extends Controller
{
    //
    public function store(Request $request) {
        $answers = $request->input('answers');
        $user_id = Auth::id();
        foreach ($answers as $question_id => $answer) {
            TestAnswer::updateOrCreate(
                array(
                    'question_id' => $question_id,
                    'answer' => $answer,
                    'user_id' => $user_id
                 )
                );

        }

        $User = User::find($user_id);
        $User->test_taken = 1;
        $User->save();
        return redirect('/wait');
    }
}
