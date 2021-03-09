<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileController extends Controller
{
    public function index(Request $request)
    {
        if(auth()->user()) {
            $url = $request->url();
            $urlarray = explode('/',$url);
            $filename = end($urlarray);
            $storagepath = storage_path();
            $pathtofile = $storagepath . '/app/public/files/' . $filename;
            return response()->file($pathtofile);
        }
        else {
            return "Fjöl av!";
        }
    }
}
