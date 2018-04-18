<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class StorageController extends Controller
{
    public function show($filename){
        $path = storage_path('app\public\\' . $filename);
        if (!\File::exists($path)) {
            // abort(404);
            return "file not exist " . $path;
        }

        $file = \File::get($path);
        $type = \File::mimeType($path);

        $response = Response::make($file, 200);
        $response->header("Content-Type", $type);

        return $response;
    }
}
