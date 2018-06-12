<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionaire;
use App\Questions;
use App\QuestionOptions;
use Validator;

class QuestionController extends Controller
{
    //

    public function add($id){
        $questionaire = Questionaire::find($id);
        return view('question.questionAdd',compact('questionaire'));
    }
    public function store(Request $request){
        //return $request->all();
        $question_type = $request->question_type;
        $questionaire_id = $request->questionaire_id;
        $question_text= $request->question_text;

        for($i=0;$i<sizeof($question_type); $i++){
            $type=$question_type[$i];
            $answer_key = "choice".$i;
            $answer = $request->{$answer_key};
            $question = Questions::create([
                'questionaire_id'=>$questionaire_id,
                'question_text'=>$question_text[$i],
                'question_type'=>$question_type[$i]
            ]);
            if($type == 'text'){
                
                $questionoption = QuestionOptions::create([
                    'question_id'=>$question->id,
                    'option'=>$answer[0],
                ]);
                //return $questionoption;
            }
            else if($type=='mcso'){
                $correct = $request->{"mcso".$i};
                for($j=0; $j<sizeof($answer); $j++){
                    $questionoption = QuestionOptions::create([
                        'question_id'=>$question->id,
                        'option'=>$answer[0],
                        'correct'=>in_array( $j ,$correct ) ? 1:0,
                    ]);
                }
                
            }
            else if($type=='mcmo'){
                $correct = $request->{"mcmo".$i};
                for($j=0; $j<sizeof($answer); $j++){
                    $questionoption = QuestionOptions::create([
                        'question_id'=>$question->id,
                        'option'=>$answer[0],
                        'correct'=>in_array( $j ,$correct ) ? 1:0,
                    ]);
                }
                
            }
        }
        
        
        return redirect()->route('questionaire.index')->with('update','Question Saved Successful');
        
    }
}
