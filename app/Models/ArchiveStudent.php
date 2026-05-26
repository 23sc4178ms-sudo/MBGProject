<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ArchivedStudent extends Model
{
    protected $fillable = [
        'name',
        'age',
        'course',
        'email',
        'contact_number',
        'address'
    ];
}