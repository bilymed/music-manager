<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $fillable = ['name'];

    public function music()
    {
        return $this->hasMany('App\Music');
    }
}
