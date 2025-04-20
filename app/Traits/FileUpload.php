<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

trait FileUpload {
    public function uploadFile(UploadedFile $file, string $directory = 'uploads') : string {
        $filename = 'ha_cource'.uniqid().'.'. $file->getClientOriginalExtension();

        // move the file to storage
        $file->move(public_path($directory), $filename);

        return '/'. $directory. '/'. $filename;
    }

    public function deleteFile(String $path) : bool {
        if(File::exists(public_path($path))){
            File::delete(public_path($path));
            return true;
        }
        return false;
    }
}
