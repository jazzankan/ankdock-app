<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\File;
use App\Models\Memfile;
use App\Models\Recipefile;

class UploadFileController extends Controller
{
    public function index(Request $request)
    {
        $request->validate([
            'fileToUpload' => 'required|file|mimes:docx,xlxs,odt,ods,pdf,jpg,jpeg,png,gif|max:10240',
        ]);

        $fileName = request()->fileToUpload->getClientOriginalName();

        $path = $request->fileToUpload->storeAs('files',$fileName);

        if($path){
            $file = new File;
            $file->filename = $fileName;
            $file->projectid = $request->projectid;
            $file->save();
        }
        return redirect('/projects/' . $request->projectid);
    }

    public function memories(Request $request)
    {
        $request->validate([
            'fileToUpload' => 'required|file|mimes:docx,xlxs,odt,ods,pdf,jpg,jpeg,png,gif|max:10240',
        ]);

        $fileName = request()->fileToUpload->getClientOriginalName();

        $path = $request->fileToUpload->storeAs('files',$fileName);

        if($path){
            $file = new Memfile;
            $file->filename = $fileName;
            $file->memoryid = $request->memoryid;
            $file->save();
        }
        return redirect('/memories/'. $request->memoryid);
    }

    public function recipes(Request $request)
    {
        $request->validate([
            'fileToUpload' => 'required|file|mimes:docx,odt,ods,pdf,jpg,jpeg,png,gif|max:10240',
        ]);

        $fileName = request()->fileToUpload->getClientOriginalName();

        $path = $request->fileToUpload->storeAs('files',$fileName);
        dd(keys());

        if($path){
            $file = new Recipefile;
            $file->filename = $fileName;
            $file->save();
        }
        //$request->flash();
        return redirect('recipes/create')->withInput()->with('fileName', $fileName);
        //withInput() Session saknas?
    }
}
