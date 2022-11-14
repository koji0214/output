<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;


class WakeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $count = \App\Question::count();  //レコード数取得
        // $rand_keys = array_rand(range(1, $count), 9);
        
        // $rand_keys = array_map(function ($n){
        //     return $n+1;
        // }, $rand_keys);
        // // dd($rand_keys);
        // $question = Question::find($rand_keys);
        
        $question = Question::inRandomOrder()->take(9)->get();
        // dd($question);
        
        
        $correct_keys = array_rand(range(0,5), 3);
        // dd($correct_keys);
        $questions = [];
        foreach($correct_keys as $i){
            array_push($questions, $question[$i]);
        }
        // dd($question[8]);
        $choice = [];
        for($i=0;$i<9;$i++){
            if(in_array($i, $correct_keys)){
                continue;
            }else{
                array_push($choice,$question[$i]->correct);
            }
        }
        
        $answer_id = [];
        $serrect = [];
        for($i=0;$i<3;$i++){
            $ans = random_int(0,2);
            array_push($answer_id, $ans);
            $choice_ = [];
            for($j=0;$j<3;$j++){
                if($j == $ans){
                    array_push($choice_, $questions[$i]->correct);
                }else{
                    if(count($choice_)>1){
                        array_push($choice_, $choice[2*$i+1]);
                    }else{
                        array_push($choice_, $choice[2*$i]);
                    }
                }
            }
            array_push($serrect, $choice_);
        }
        
        
        // dd($serrect);
        
        return view('wake')->with(['question' => $questions,
            'choices' => $serrect,
            'correct_key' => $answer_id,
        ]);;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        return redirect(route('home.create'));
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
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
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
    }
}
