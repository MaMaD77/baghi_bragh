<?php

namespace App\Traits;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Sopamo\LaravelFilepond\Filepond;
use Intervention\Image\Facades\Image;

trait HasMorphFileUpload
{

    /**
     * @param $serverId
     * @param $type
     * @param $path
     * @param $fileName
     * @return $path
     */
    public function uploadFile($serverId, $type, $path, $fileName)
    {
        $filepond = app(Filepond::class);
        $tempPath = $filepond->getPathFromServerId($serverId);

        $extension = pathinfo(storage_path($tempPath), PATHINFO_EXTENSION);
        $originalFileName = pathinfo(storage_path($tempPath), PATHINFO_FILENAME) . '.' . $extension;;

        // if ($extension == 'png' || $extension == 'PNG' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'JPG' || $extension == 'JPEG') {
        //     $img = Image::make('storage/' . $tempPath)->resize(1000, 1000, function ($constraint) {
        //         $constraint->aspectRatio();
        //         $constraint->upsize();
        //     });
        //     $img->save();
        // }

        $size = Storage::disk(config('filepond.temporary_files_disk'))->size($tempPath);
        $mimeType = Storage::disk(config('filepond.temporary_files_disk'))->mimeType($tempPath);

        $fileName = $fileName . '.' . $extension;
        $path = $path . '/' . $fileName;

        $contents = Storage::disk(config('filepond.temporary_files_disk'))->get($tempPath);
        Storage::put($path, $contents);

        // Storage::move($tempPath, $path);

        $file = File::create([
            'fileable_type' => $this->getMorphClass(),
            'fileable_id' => $this->id,
            'path' => $path,
            'name' => $originalFileName,
            'extension' => $extension,
            'size' => $size,
            'mime_type' => $mimeType,
            'type' => $type,
        ]);

        return $file;
    }

    /**
     * @param $serverId
     * @param $type
     * @param $path
     * @param $fileName
     * @return $path
     */
    public function uploadUuidFile($serverId, $type, $path, $fileName)
    {
        $filepond = app(Filepond::class);
        $tempPath = $filepond->getPathFromServerId($serverId);

        $extension = pathinfo(storage_path($tempPath), PATHINFO_EXTENSION);
        $originalFileName = pathinfo(storage_path($tempPath), PATHINFO_FILENAME) . '.' . $extension;

        // if ($extension == 'png' || $extension == 'PNG' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'JPG' || $extension == 'JPEG') {
        //     $img = Image::make('storage/' . $tempPath)->resize(1000, 1000, function ($constraint) {
        //         $constraint->aspectRatio();
        //         $constraint->upsize();
        //     });
        //     $img->save();
        // }

        $size = Storage::disk(config('filepond.temporary_files_disk'))->size($tempPath);
        $mimeType = Storage::disk(config('filepond.temporary_files_disk'))->mimeType($tempPath);

        $fileName = $fileName . '.' . $extension;
        $path = $path . '/' . $fileName;

        $contents = Storage::disk(config('filepond.temporary_files_disk'))->get($tempPath);
        Storage::put($path, $contents);

        // Storage::move($tempPath, $path);

        $file = File::create([
            'attachmentable_type' => $this->getMorphClass(),
            'attachmentable_id' => $this->id,
            'path' => $path,
            'name' => $originalFileName,
            'extension' => $extension,
            'size' => $size,
            'mime_type' => $mimeType,
            'type' => $type,
        ]);

        return $file;
    }

    /**
     * @param $file
     * @param $type
     * @param $path
     * @param $fileName
     * @return $path
     */
    public function uploadFileApi($file, $type, $path, $fileName)
    {
        $extension = $file->extension();

        // if ($extension == 'png' || $extension == 'PNG' || $extension == 'jpg' || $extension == 'jpeg' || $extension == 'JPG' || $extension == 'JPEG') {
        //     $img = Image::make($file)->resize(1000, 1000, function ($constraint) {
        //         $constraint->aspectRatio();
        //         $constraint->upsize();
        //     });
        //     $img->save();
        // }

        $fileName = $fileName . '.' . $extension;

        $path = Storage::putFileAs($path, $file, $fileName);

        $size = Storage::size($path);
        $mimeType = Storage::mimeType($path);

        $file = File::create([
            'fileable_type' => $this->getMorphClass(),
            'fileable_id' => $this->id,
            'path' => $path,
            'name' => $fileName,
            'extension' => $extension,
            'size' => $size,
            'mime_type' => $mimeType,
            'type' => $type,
        ]);

        return $file;
    }
}
