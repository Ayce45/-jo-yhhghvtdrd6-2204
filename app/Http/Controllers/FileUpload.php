<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FileUpload extends Controller
{
    public function createForm() {
        return view('file-upload', ['files' => File::where('user_id', '=', Auth::id())->get()]);
    }

    public function fileUpload(Request $request) {
        $fileModel = new File;
        $request->validate(['file' => 'required']);
        if($request->file()) {
            $fileName = time().'_'.$request->file->getClientOriginalName();
            $filePath = $request->file('file')->storeAs('uploads', $fileName, 'public');
            $fileModel->name = time().'_'.$request->file->getClientOriginalName();
            $fileModel->file_path = 'app/public/' . $filePath;
            $fileModel->user_id = Auth::id();
            $fileModel->save();
            return back()
                ->with('success','File has been uploaded.')
                ->with('file', $fileName);
        }
    }
    public function fileDownload(File $file)
    {
        if ($file->user_id === Auth::id()) {
            return response()->download(storage_path($file->file_path));
        }
    }
}
