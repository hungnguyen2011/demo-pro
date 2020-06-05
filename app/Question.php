<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'questions';

    protected $fillable = [
        'question_content','exam_id'
    ];
    public function answer()
    {
        return $this->hasMany('App\Answer');
    }
}
