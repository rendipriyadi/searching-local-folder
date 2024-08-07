<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class FileSearchController extends Controller
{
    public function showDirectoryContent(Request $request, $path = '')
    {
        $rootDirectory = 'D:'; // Set root directory path here
        $fullPath = $path ? $rootDirectory . '\\' . $path : $rootDirectory;

        // Ensure the full path is safe
        $fullPath = realpath($fullPath);

        if (!$fullPath || !File::exists($fullPath) || !File::isDirectory($fullPath)) {
            return abort(404, 'Directory not found');
        }

        $directories = File::directories($fullPath);
        $files = File::files($fullPath);

        // Handle search query
        $query = $request->input('query');
        if ($query) {
            $directories = array_filter($directories, function ($dir) use ($query) {
                return stripos(basename($dir), $query) !== false;
            });
            $files = array_filter($files, function ($file) use ($query) {
                return stripos(basename($file), $query) !== false;
            });
        }

        return view('directory', [
            'directories' => $directories,
            'files' => $files,
            'currentPath' => $path
        ]);
    }

    public function serveFile($filePath)
    {
        $filePath = 'D:\\' . urldecode($filePath);
        $filePath = realpath($filePath);

        if (File::exists($filePath)) {
            return response()->file($filePath);
        }

        return abort(404, 'File not found');
    }
}
