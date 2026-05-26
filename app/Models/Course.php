<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    protected $fillable = ['course_name', 'description'];

    public function student()
    {
        return $this->belongsToMany(student::class, 'course_enrollments', 'couse_id', 'student_id' );
    }
}
