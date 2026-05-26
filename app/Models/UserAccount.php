<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserAccount extends Model
{
    protected $fillable = [
        'username',
        'email',
        'password',
        'role',
        'is_active',
        'password_changed_at'
    ];
    
    protected $casts = [
        'password_changed_at' => 'datetime',
    ];
    
     public function student(){
        return $this->hasOne(Student::class, 'user_account_id');
    }

}

