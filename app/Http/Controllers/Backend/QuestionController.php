<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Question;
use Illuminate\Support\Carbon;

class QuestionController extends Controller
{    
    public function __construct(){
      
      $this->middleware('auth');

    }
        public function QuestionView()
    {
    	$questions = Question::latest()->get();
        return view('backend.setup.question.index', compact('questions'));
    }

         public function QuestionAdd()
    {
    	return view('backend.setup.question.add');
    }

      public function QuestionStore(Request $request){

           $validatedData = $request->validate([
            'question' => 'required',
            'answer' => 'required',

        ]);
 
        Question::insert([
            'question' => $request->question,
            'answer' => $request->answer,
            'created_at' => Carbon::now()
        ]);
         
        $notification = array(
           'message' => 'FAQ Added Successfully',
           'alert-type' => 'success'
        );

        return redirect()->route('question.view')->with($notification);

    }

    public function QuestionEdit($id)
    {
        $editData = Question::find($id);
        return view('backend.setup.question.edit',compact('editData'));
    }

    public function QuestionUpdate(Request $request,$id){
       
           $validatedData = $request->validate([
            'question' => 'required',
            'answer' => 'required',

        ]);;

        $data = Question::find($id);
        $data->question = $request->question;
        $data->answer = $request->answer;
        $data->save();
        
        $notification = array(
           'message' => 'FAQ Updated Successfully',
           'alert-type' => 'info'
        );

        return redirect()->route('question.view')->with($notification);
    }

    public function QuestionDelete($id){

        $question = Question::find($id);
        $question->delete();

        $notification = array(
           'message' => 'FAQ Deleted Successfully',
           'alert-type' => 'error'
        );

        return redirect()->route('question.view')->with($notification);
    }
}
