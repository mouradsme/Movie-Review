<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Test;

class TestController extends Controller
{
    //
    public function index(Request $request) {

        $TestQuestions = Test::all();
        return view('test.index', array('TestQuestions' => $TestQuestions));
    }
    public function create() {
        return view('test.create');
    }

    public function store(Request $request) {
        $choices = trim($request->input('choices'));
        if (empty($choices))
            $choices = "DIRECT";

            $Genre = Test::create([
                'title' => $request->input('title'),
                'question' => $request->input('question'),
                'choices' => $choices,
            ]);
            if ($Genre->exists)
            return redirect('/test');

          else return redirect('/error');

    }

    public function delete(Request $request, $id) {
        Test::find($id)->delete();
        return redirect('/test');
    }
}
