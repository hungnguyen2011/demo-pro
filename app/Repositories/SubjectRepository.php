<?php

namespace App\Repositories;

use App\Subject;

class SubjectRepository {
	public static function listSubject()
	{
		return Subject::all();
	}

	public static function findSubjectById($id)
	{
		return Subject::find($id);
	}

	public static function checkName($req)
	{
		$id = $req->id;
        $subject = Subject::where('subject_name', $req->input('subject_name'));
        if ($id) {
            $subject = $subject->where('id','!=',$id);
        }

        return $subject->exists();
		// return Subject::where('subject_name', $req->input('subject_name'))->exists();
	}
}