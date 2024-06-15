<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileUploadController extends Controller
{
    public function fileUpload()
    {
        return view('file-upload');
    }
    public function processFileUpload(Request $request)
    {
        $request->validate([
            'file_name' => 'required|string|max:255',
            'file' => 'required|file|image|max:5000', // 5MB max file size
        ]);

        $fileName = $request->input('file_name');
        $fileExtension = $request->file->getClientOriginalExtension();
        $finalFileName = $fileName . '.' . $fileExtension;

        $path = $request->file->move(public_path('uploads'), $finalFileName);
        
        $filePath = asset('uploads/' . $finalFileName);

        echo "File berhasil diupload ke: " . $filePath;

        return view('file-display', ['filePath' => $filePath]);
    }
}
