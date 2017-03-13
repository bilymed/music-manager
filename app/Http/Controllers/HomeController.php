<?php

namespace App\Http\Controllers;

use App\Music;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use  App\MusicFile;

class HomeController extends Controller
{

    public function index()
    {
        $musics = Music::all();
        $musics->load('tag');
        return view('index', ['musics' => $musics]);
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
                $response = [
                    'name' => $file->getClientOriginalName(),
                    'type' => $file->getClientOriginalExtension(),
                    'url' => url('/music/' . $file->getClientOriginalName()),
                    'msg' => 'Uploaded',
                    'status' => true
                ];
            }

            return response()->json($response);

        } else {
            return 'No Data Found';
        }
    }
}