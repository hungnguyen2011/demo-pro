<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Subject;
use App\Exam;
use App\Question;
use App\Answer;


class ExamAdminController extends Controller
{
    public function index()
    {
    	$subject = Subject::all();
    	return view('admin.exam.index',compact('subject'));
    }

    public function showListExam($id)
    {
    	$subject = Subject::find($id)->subject_name;
    	$exams = Exam::where('subject_id',$id)->get();
    	return view('admin.exam.list-exam',compact('exams','id','subject'));
    }

    public function add($id)
    {
    	return view('admin.exam.add',compact('id'));
    }

    public function addExam(Request $req,$id)
    {
    	Exam::create($req->all());

    	return redirect()->route('admin.exam.list-exam',$id)->with('message','Bạn đã thêm mới thành công');
    	
    }

    public function edit($id, $id1)
    {
    	$exam = Exam::find($id1);
    	return view('admin.exam.edit',compact('id','exam'));
    }

    public function editExam(Request $req, $id, $id1)
    {
    	$exam = Exam::find($id1)->update($req->all());

    	return redirect()->route('admin.exam.list-exam',$id)->with('message','Bạn đã sửa thành công');
    }

    public function deleteExam($id)
    {
    	DB::begintransaction();
        try {
        	Exam::find($id)->delete();
        	$arrQuestion = Question::where('exam_id',$id)->pluck('id')->toArray();
        	Question::destroy($arrQuestion);

        	Answer::whereIn('question_id',$arrQuestion)->delete();
            DB::commit();
            return redirect()->back()->with('message','Bạn đã xóa thành công');
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return redirect()->back()->with('message-err','Bạn xóa chưa thành công');
    }

    public function showListQuestion($id)
    {
    	$exam = Exam::find($id)->exam_name;
    	$sub = Exam::find($id)->subject->subject_name;
    	$questions = Question::where('exam_id',$id)->with('answer')->get();

    	return view('admin.question.list',compact('exam','questions','sub','id'));
    }

    public function addQues($id)
    {
    	$question = Question::find($id);
    	$answers = Answer::where('question_id',$id)->get();
    	return view('admin.question.add',compact('id','question','answers'));
    }

    public function addQuestion(Request $req, $id)
    {
    	$dataQues = [
    		'question_content' => $req->question_content,
    		'exam_id' => $id
    	];
    	$dataOption = $req->option;
        DB::begintransaction();
        try {
        	Question::create($dataQues);
        	$question_id = Question::where('question_content',$req->question_content)->where('exam_id',$id)->first()->id;
        	foreach($dataOption as $key => $option){
        		if($req->Iscorrect == $key){
	        		Answer::create([
	        			'option' => $option,
	        			'question_id' => $question_id,
	        			'Iscorrect' => 1, 
	        		]);
	        	}
	        	else {
	        		Answer::create([
	        			'option' => $option,
	        			'question_id' => $question_id,
	        		]);
	        	}
            }
            $questions = Question::where('exam_id',$id)->get();
            Exam::find($id)->update(['question_count'=>count($questions)]);

            DB::commit();
            return redirect()->route('admin.exam.list-question',$id)->with('message','Bạn đã thêm thành công');;
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('admin.exam.list-question',$id)->with('message-err','Bạn thêm chưa thành công');;
    }

    public function editQues($id)
    {
    	$question = Question::find($id);
    	$answers = Answer::where('question_id',$id)->get();
    	return view('admin.question.edit',compact('question','answers'));
    }

    public function editQuestion(Request $req, $id)
    {
    	$arrAns = $req->except('_token','question_content');
    	$id = Question::find($id)->exam_id;
        DB::begintransaction();
        try {
        	Question::find($id)->update(['question_content'=> $req->question_content]);
        	foreach($arrAns as $key => $ans){
        		Answer::find($key)->update(['option'=>$ans]);
        	}
            DB::commit();
            return redirect()->route('admin.exam.list-question',$id)->with('message','Bạn đã sửa thành công');
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return redirect()->route('admin.exam.list-question',$id)->with('message-err','Bạn sửa chưa thành công');
    }

    public function deleteQuestion($id)
    {
    	DB::begintransaction();
        try {
        	$question = Question::find($id);
            $exam_id = $question->exam_id;
            $question->delete();
        	$arrAns = Answer::where('question_id',$id)->pluck('id')->toArray();
        	Answer::destroy($arrAns);

            $questions = Question::where('exam_id',$exam_id)->get();
            Exam::find($exam_id)->update(['question_count'=>count($questions)]);

            DB::commit();
            return redirect()->back()->with('message','Bạn đã xóa thành công');
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return redirect()->back()->with('message-err','Bạn xóa chưa thành công');
    }
}
