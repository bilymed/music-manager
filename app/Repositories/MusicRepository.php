<?php
/**
 * Created by PhpStorm.
 * User: bakab
 * Date: 3/20/2017
 * Time: 5:45 PM
 */

namespace App\Repositories;

use App\Music;


class MusicRepository implements IMusicRepository
{
    private $music;

    public function __construct(Music $music)
    {
        $this->music = $music;
    }

    public function find($id)
    {
        return $this->music->where('id', $id)->first();
    }

    public function findBy($att, $column)
    {
        return $this->music->where($att, $column)->get();
    }

    public function save(){
        return $this->music->save();
    }
}