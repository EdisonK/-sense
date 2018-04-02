<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cache;

class User extends Model
{
    protected $table = 'user';

    public $timestamps = false;

    protected $guarded = ['id'];

    protected $hidden = ['password'];

    public static function user($sess_key)
    {
        $cache = Cache::get($sess_key);
        $user = User::find($cache['id']);
        return $user;

    }
}
