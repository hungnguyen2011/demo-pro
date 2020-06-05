<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    protected $table = 'exams';

    protected $fillable = [
        'exam_name', 'question_count', 'duration', 'description', 'subject_id'
    ];

    public function subject()
    {
        return $this->belongsTo('App\Subject');
    }

    public function question()
    {
        return $this->hasMany('App\Question');
    }

    public function user_exam()
    {
        return $this->hasMany('App\User_Exam');
    }
}
