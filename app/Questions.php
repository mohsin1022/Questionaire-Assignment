<?php

namespace App;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Model;

class Questions extends Model
{
    //
    use SoftDeletes;
    
    protected $fillable = ['question_text', 'question_type', 'questionaire_id', 'deleted_at'];

    public function questionaire()
    {
        return $this->belongsTo(Questionaire::class, 'questionaire_id');
    }

    public function questionoptions()
    {
        return $this->hasMany(QuestionOptions::class, 'question_id')->withTrashed();
    }
}
