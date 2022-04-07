<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher_Subject extends Model
{
    protected $table = 'teacher__subjects';

    protected $fillable = [
        'teacher_id', 'subject_id'
    ];

    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
