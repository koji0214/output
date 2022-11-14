<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\QuestionCategory;
use App\Level;
use Illuminate\Support\Facades\Auth;

class QuestionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Question $question)
    {
        return view('question.index')->with(['question' => $question->getPaginateByLimit()]);;
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(QuestionCategory $category)
    {
        //
        return view('question.create')->with(['categories'=>$category->get()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request){
        $question = new Question;
        $input = $request['question'];
        
        $question->question = $input["question"];
        $question->correct = $input["correct"];
        $question->question_category_id = 1;
        $question->save();
        $level = Level::find(Auth::id());
        $level->level += 5;
        $level->save();
        return redirect(route('question.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $question = Question::find($id);
        return view('question.edit')->with([
            'question' => $question
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Question $question)
    {
        //
        // $question = Question::find($id);
        // $question->question = $request->input('');
        $input = $request['question'];
        $question->fill($input)->save();
        return redirect(route('question.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        Question::find($id)->delete();
        return redirect(route('question.index'));
    }
}
