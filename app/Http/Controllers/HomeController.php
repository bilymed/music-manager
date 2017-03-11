<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;


class HomeController extends Controller{

    public function index(){
        $files = File::all();
        return view('index', ['files' => $files]);
    }

    public function upload(Request $request){

        $file = $request->file('file');
        $name = $file->getClientOriginalName();
        $ext = $file->getClientOriginalExtension();

       $path = $file->storeAs('music/', "{$name}.{$ext}");

       $file = new \App\File();
       $file->path = $path;
       $file->save();

      // $request->file('file')->store('music');
      // return back();
    }
}
