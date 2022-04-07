<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $table = 'students';

    protected $fillable = [
        'nama', 'alamat', 'JK', 'kelas'
    ];
    
    public function subjects()
    {
        return $this->hasMany(Student_Subject::class);
    }
}
