<?php

namespace App\Http\Controllers;

use App\Questionaire;
use Illuminate\Http\Request;
use Validator;

class QuestionaireController extends Controller
{
    //
    public function index()
    {
        $questionairs = Questionaire::withCount('questions')->where('user_id', \Auth::user()->id)->get();
        //return $questionairs;
        return view('questionaire.questionaireList',compact('questionairs'));
    }


    public function create(){
        $questionaire =null;
        return view('questionaire.questionaireCreate',compact('questionaire '));
    }

    public function store(Request $request){
        Validator::make($request->all(), [
            'name' => 'required|max:255',
            'duration' => 'required',
            'can_resume'=>'required'
        ])->validate();
        
        if($request->duration_type == 'hours'){
            $request->duration_type  = $request->duration_type *60;
        }
        if($request->id){
            $questionaire = Questionaire::find($request->id);

            $questionaire->name = $request->name;
            $questionaire->can_resume = $request->can_resume;
            $questionaire->duration = $request->duration;
            $questionaire->save();
            return redirect()->route('questionaire.index');
        }
        $data = $request->all();

        $data['user_id'] = \Auth::user()->id;
        Questionaire::create($data);

        return redirect()->route('questionaire.index');
        //return view('questionaire.questionaireCreate');
    }

    public function edit($id)
    {
        $questionaire = Questionaire::find($id);
        //return $questionaire;
        return view('questionaire.questionaireCreate', compact('questionaire'));
    }

    public function destroy($id)
    {
        $questionaire = Questionaire::findOrFail($id);
        $questionaire->delete();
        return redirect()->route('questionaire.index');
    }

}
