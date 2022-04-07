<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    protected $table = 'subjects';
    
    protected $fillable = [
        'nama'
    ];

    public function studentSubject()
    {
        return $this->hasMany(Student_Subject::class);
    }

    public function teacherSubject()
    {
        return $this->hasMany(Teacher_Subject::class);
    }
}
