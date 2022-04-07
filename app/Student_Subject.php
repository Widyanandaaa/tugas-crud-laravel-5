<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student_Subject extends Model
{
    protected $table = 'student__subjects';

    protected $fillable = [
        'student_id', 'subject_id'
    ];

    public function student()
    {
        return $this->belongsTo(Student::class);
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
}
