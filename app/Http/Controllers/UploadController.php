<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FileUpload;
use Exception;

class UploadController extends Controller
{
    public function upload(Request $request)
    {
        try {
            if (!empty($request->file)) {
                $image = $request->file;
                $fileName = strtotime(now()) . "_" . $image->getClientOriginalName();
                $image->storeAs('public/file-upload/', $fileName);
            }

            $storeFile = FileUpload::create([
                'name' => $request->name,
                'path' => $fileName ?? null
            ]);

            return response()->json(['message' => 'Success upload file']);
        } catch (Exception $error) {
            return $error->getMessage();
        }
    }
}
