<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    protected $table = 'teachers';
    
    protected $fillable = [
        'nama', 'alamat', 'JK'
    ];

    public function subjects()
    {
        return $this->hasMany(Teacher_Subject::class);
    }
}
