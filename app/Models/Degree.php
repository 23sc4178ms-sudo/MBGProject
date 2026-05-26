<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    protected $fillable = ['Degree', 'name'];
    
    // Alias for convenience
    public function getNameAttribute()
    {
        return $this->Degree;
    }
}
