<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;

trait FileUpload
{
    public function uploadFile(UploadedFile $file, string $directory = 'uploads'): string
    {
        try {
            $filename = 'ha_cource' . uniqid() . '.' . $file->getClientOriginalExtension();

            // move the file to storage
            $file->storeAs($directory, $filename, 'public');

            return '/' . $directory . '/' . $filename;
        } catch (\Exception $e) {
            throw $e;
        }
    }

    public function deleteFile(?string $path): bool
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));

            return true;
        }

        return false;
    }
}
