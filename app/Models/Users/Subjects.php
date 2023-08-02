<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Subjects extends Model
{
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];
    //userとsubjectは多対多の関係
    public function users(){
        return $this->belongsToMany('App\Models\Users\User');
    }
}
