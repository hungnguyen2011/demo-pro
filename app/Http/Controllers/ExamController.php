<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\SubjectRepository;
use App\Repositories\ExamRepository;
use App\Question;
use App\Answer;
use App\Exam;
use App\User_Exam;
use Auth;

class ExamController extends Controller
{
    public function test()
    {
        $subject = SubjectRepository::listSubject();
        return view('web.test.test',compact('subject'));
    }

    public function showDetailTest($id)
    {
        $subject_name = SubjectRepository::findSubjectById($id)->subject_name;
        $subject = SubjectRepository::listSubject();
        $exams = Exam::where('subject_id',$id)->with('user_exam')->get();

        return view('web.test.detail-test',compact('subject','subject_name','exams'));
    }

    public function startTest($id)
    {
        $exam = ExamRepository::findExamById($id);
        $subject_name = SubjectRepository::findSubjectById($id)->subject_name;
        $questions = Question::where('exam_id',$id)->with('answer')->get();
        
        return view('web.test.start-exam',compact('exam','questions','subject_name'));
    }

    public function postTest(Request $req,$id)
    {
        $arrAnswer = $req->except('_token');
        //số câu đã làm
        $amount = count($arrAnswer);
        //tổng số câu
        $questions_count = Exam::find($id)->question_count;
        //số câu còn lại
        $rest = $questions_count - $amount;
        //số câu đúng
        $count = 0;
        foreach($arrAnswer as $ans){
            $correct = Answer::find($ans)->Iscorrect;
            if(isset($correct)) $count++; 
        }

        $questions_id = Question::where('exam_id',$id)->pluck('id')->toArray();
        $arrCorrect = [];
        foreach ($questions_id as $ques_id) {
            $correct = Answer::where('question_id',$ques_id)
                            ->where('Iscorrect',1)
                            ->pluck('id')
                            ->toArray();
            $arrCorrect = array_merge($arrCorrect,$correct);
        }

        $exam_user = new User_Exam();
        $exam_user->user_id = Auth::user()->id;
        $exam_user->exam_id = $id;
        $exam_user->result = $count;
        $exam_user->save();

        return response()->json(['count'=>$count,'amount'=>$amount,'rest'=>$rest,'questions_count'=>$questions_count,'arrAnswer'=>$arrAnswer,'arrCorrect'=>$arrCorrect]);
    }
}
