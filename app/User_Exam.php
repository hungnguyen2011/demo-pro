<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Exam extends Model
{
    protected $table = 'user_exam';
    protected $fillable = [
        'user_id', 'exam_id', 'result',
    ];

    public function exam(){
    	return $this->belongsTo('App\Exam');
    }
}
