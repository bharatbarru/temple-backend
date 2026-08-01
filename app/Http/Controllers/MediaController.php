<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laracasts\Flash\Flash;
use Illuminate\Support\Facades\File;

class MediaController extends Controller
{
    public function media()
    {
        // Get all files except .html and sort by creation time (newest first)
        $files = collect(File::files(public_path('images/media')))
            ->filter(function ($file) {
                return strtolower($file->getExtension()) !== 'html';
            })
            ->sortByDesc(function ($file) {
                return $file->getCTime();
            })
            ->map(function ($file) {
                return [
                    'filename' => $file->getFilename(),
                    'path' => $file->getPathname(),
                    'extension' => strtolower($file->getExtension()),
                    'created_at' => filectime($file->getPathname())
                ];
            });

        return view('media', compact('files'));
    }
    public function uploadMedia(Request $request)
    {
        if ($request->hasfile('image')) {
            foreach ($request->file('image') as $image) {
                uploadImage($image, 'images/media/', null, null);
            }
        }
        Flash::success('Images uploaded successfull');
        return redirect(url('admin/media'));
    }

    public function removeMedia($img)
    {
        removeImage($img, 'images/media/');
        Flash::success('Images removed successfully');
        return redirect(url('admin/media'));
    }
}
