<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $table = 'question';

    public $timestamps = false;

    protected $guarded = ['id'];

    public function option()
    {
        return $this->hasMany(Option::class,'question_id','id');
    }
}
