<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';

    protected $fillable = [
        'subject_name', 'image'
    ];

    public function exam()
    {
        return $this->hasMany('App\Exam');
    }
}
