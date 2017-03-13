<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    public $fillable = ['name', 'url', 'tag_id'];

    public function tag()
    {
        return $this->belongsTo('App\Tag');
    }
}
