<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;

class FileUpload extends Controller
{
    public function createForm() {
        return view('file-upload', ['files' => File::all()]);
    }

    public function fileUpload(Request $request) {
        $fileModel = new File;
        $request->validate(['file' => 'required']);
        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = time().'_'.$request->file->getClientOriginalName();
            $fileModel->file_path = 'app/public/' . $filePath;
            $fileModel->save();
            return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
        }
    }
    public function fileDownload(File $file)
    {
    return response()->download(storage_path($file->file_path));
}
}
