<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FileSearchController extends Controller
{
    public function search(Request $request)
    {
        // Validasi input pencarian
        $request->validate([
            'query' => 'required|string',
        ]);

        $query = $request->input('query');
        $directory = '\\\\sn1jkt03\\m-tools$\\M-Tool\\Documents';

        // Array untuk menyimpan hasil pencarian
        $results = [];

        // RecursiveDirectoryIterator untuk iterasi melalui subfolder
        $iterator = new \RecursiveIteratorIterator(new \RecursiveDirectoryIterator($directory));
        foreach ($iterator as $file) {
            if (strpos($file->getFilename(), $query) !== false) {
                $results[] = $file->getPathname();
            }
        }

        // Jika file atau folder ditemukan
        if (count($results) > 0) {
            // Ambil path dari file atau folder pertama yang ditemukan
            $firstResult = $results[0];

            // Jalankan File Explorer dan buka lokasi file/folder tersebut
            exec('start "" "' . dirname($firstResult) . '"');

            // Redirect atau return sesuai kebutuhan
            return redirect()->back()->with('success', 'File Explorer berhasil dibuka.');
        } else {
            return redirect()->back()->with('error', 'Tidak ada file atau folder yang ditemukan.');
        }
    }
}
