<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Reaction extends Model
{
    protected $fillable = [
        'from_user_id',
        'to_user_id',
        'status'
        ];
    
    public function fromUser()
    {
        return $this->belongsTo('App\User', 'from_user_id', 'id');
    }
    public function toUser()
    {
        return $this->belongsTo('App\User', 'to_user_id', 'id');
    }
    // public function User()
    // {
    //     return $this->hasMany('App\User', 'to_user_id', 'id');
    // }
    
}
