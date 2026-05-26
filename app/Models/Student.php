<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Student extends Model
{
    protected $fillable = [
        'name', 
        'mname', 
        'lname', 
        'contact', 
        'degree_id',
        'user_account_id',
        'email',
    ];

    public function degree(): BelongsTo
    {
        return $this->belongsTo(Degree::class);
    }

    public function course()
    {
        return $this->hasMany(Course::class,'course_enrollments', 'course_id', 'student_id');
    }
    public function userAccount(){
        return $this->belongsTo(UserAccount::class);
    }
}
