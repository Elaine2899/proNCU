<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Event extends Model
{
    use HasFactory;

    protected $fillable = ['events_name', 'end_time', 'user_sid'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }



}
