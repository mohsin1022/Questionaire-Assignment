<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Questionaire extends Model
{
    //
  

    protected $fillable = ['name', 'duration', 'can_resume', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id')->withTrashed();
    }

    public function questions()
    {
        return $this->hasMany(Questions::class, 'questionaire_id');
    }
}
