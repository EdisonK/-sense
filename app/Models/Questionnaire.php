<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Questionnaire extends Model
{
    protected $table = 'questionnaire';

    public $timestamps = false;

    protected $guarded = ['id'];
}
