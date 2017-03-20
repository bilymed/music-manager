<?php

namespace App\Repositories;

interface IMusicRepository
{
    public function find($id);

    public function findBy($att, $column);

    public function save();
}