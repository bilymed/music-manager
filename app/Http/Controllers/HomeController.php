<?php

namespace App\Http\Controllers;

use App\Music;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class HomeController extends Controller
{

    public function index()
    {
        $musics = Music::all();
        $tags = Tag::all();
        $musics->load('tag');
        return view('index', ['musics' => $musics, 'tags' => $tags]);
    }

    public function findByTag(Request $request, Music $music, $id)
    {
        if ($id == "0") {
            $musics = $music->all();
            $musics->load('tag');
        } else {
            $musics = $music->where('tag_id', $id)->get();
            $musics->load('tag');
        }

        return response()->json(["musics" => $musics]);
    }

    public function findByName(Request $request, Music $music)
    {

        $name = $request->get('name');
        $tag_id = $request->get('tag_id');

        if ($name == null && $tag_id == null) {
            return false;
        } else {
            if ($tag_id == 0) {
                $musics = $music->where('name', 'like', '%' . $name . '%')->get();
                $musics->load('tag');
            } else {
                $musics = $music->where('name', 'like', '%' . $name . '%')->where('tag_id', $tag_id)->get();
                $musics->load('tag');
            }

            return response()->json(["musics" => $musics]);
        }

    }

    public function upload(Request $request)
    {
        $allow = ['mp3', 'wav'];

        if ($request->hasFile('file')) {

            $file = $request->file('file');

            if (!in_array(strtolower($file->getClientOriginalExtension()), $allow)) {

                $response = [
                    'name' => $file->getFilename(),
                    'type' => $file->getType(),
                    'url' => '',
                    'msg' => 'invald type',
                    'status' => false
                ];

            } else {
                $file->move(public_path() . '/music/', $file->getClientOriginalName());
                $music = new Music();
                $music->name = $request->input('music-name');
                $music->url = '/music/' . $file->getClientOriginalName();
                $music->tag_id = $request->input('music-tag');
                $music->save();
                $tag = new Tag();
                $response = [
                    'name' => $file->getClientOriginalName(),
                    'music-name' => $request->input('music-name'),
                    'tag' => $tag->where('id', $request->input('music-tag'))->first(),
                    'type' => $file->getClientOriginalExtension(),
                    'url' => url('/music/' . $file->getClientOriginalName()),
                    'msg' => 'Uploaded',
                    'status' => true
                ];
            }

            return response()->json(["track" => $response]);

        } else {
            return 'No Data Found';
        }
    }
}