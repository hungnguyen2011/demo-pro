<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Subject;
use App\Exam;
use App\Question;
use App\Answer;
use DB;
use App\Repositories\SubjectRepository;

class SubjectAdminController extends Controller
{
    public function index()
    {
    	$subjects = Subject::all();
    	return view('admin.subject.list',compact('subjects'));
    }

    public function add()
    {
        return view('admin.subject.add');
    }

    public function addSubject(Request $req)
    {
        if ($req->hasFile('image'))
        {
            $file_name = $req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/image_store',$file_name);
            $data = array_merge($req->all(), ["image" => '/image_store/' . $file_name]);
            Subject::create($data);

            return redirect()->route('admin.subject.list')->with('message','Bạn đã thêm thành công');
        }
        else
            return redirect()->route('admin.subject.list')->with('message-error','Bạn chưa thêm thành công');
        
    }

    public function edit($id)
    {
        $subject = Subject::find($id);
        return view('admin.subject.edit',compact('subject'));
    }

    public function editSubject(Request $req, $id)
    {
        if ($req->hasFile('image'))
        {
            $file_name = $req->file('image')->getClientOriginalName();
            $req->file('image')->storeAs('public/image_store',$file_name);
            $data = array_merge($req->all(), ["image" => '/image_store/' . $file_name]);
            Subject::find($id)->update($data);

            return redirect()->route('admin.subject.list')->with('message','Bạn đã sửa thành công');
        }
        else
            return redirect()->route('admin.subject.list')->with('message-error','Bạn chưa sửa thành công');
    }

    public function deleteSubject($id)
    {
        DB::begintransaction();
        try {
            Subject::find($id)->delete();
            $arrExam = Exam::where('subject_id',$id)->pluck('id')->toArray();
            Exam::destroy($arrExam);

            $arrQuestion = Question::whereIn('exam_id',$arrExam)->pluck('id')->toArray();
            Question::destroy($arrQuestion);

            Answer::whereIn('question_id',$arrQuestion)->delete();
            DB::commit();
            return redirect()->back()->with('message','Bạn đã xóa thành công');
        } catch (\Exception $e) {
            DB::rollBack();
        }

        return redirect()->back()->with('message-err','Bạn xóa chưa thành công');
    }

    public function checkSubject(Request $req)
    {
        return response()->json(SubjectRepository::checkName($req));
    }
}
