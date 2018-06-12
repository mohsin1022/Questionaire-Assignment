<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionOptions extends Model
{
    //
    protected $fillable = ['option', 'correct', 'question_id'];
    
    
    /**
     * Set to null if empty
     * @param $input
     */
    
    public function question()
    {
        return $this->belongsTo(Question::class, 'question_id')->withTrashed();
    }
}
