<?php

namespace App\Repositories;

use App\Exam;
use App\Question;

class ExamRepository {

	public static function findExamById($id)
	{
		return Exam::find($id);
	}

	public static function findQuestionById($id)
	{
		return Question::find($id);
	}
}