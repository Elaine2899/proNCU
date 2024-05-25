<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;

    public function event(){

        return $this -> hasMany(Event::class);
    }

    public function course(){

        return $this -> hasMany(Course::class);
    }
}
