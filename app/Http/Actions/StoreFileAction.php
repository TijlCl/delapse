<?php
namespace App\Http\Actions;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StoreFileAction
{
    /**
     * @param UploadedFile $file
     * @param string $folderPath
     * @return string
     */
    public function execute(UploadedFile $file, string $folderPath): string
    {
        // source to rename files automatically: https://stackoverflow.com/questions/41588306/laravel-to-rename-an-uploaded-file-automatically
        $md5Name = md5_file($file->getRealPath());
        $guessExtension = $file->guessExtension();
        $absoluteFilePath = $folderPath . $md5Name.'.'.$guessExtension;

        $file->storeAs($folderPath, $md5Name.'.'.$guessExtension  ,'public');
        return $absoluteFilePath;
    }
}
