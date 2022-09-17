<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view('file-upload');
    }

    public function uploadToApi(Request $request)
    {
        $file               = request('file');
        $file_path          = $file->getPathname();
        $file_mime          = $file->getMimeType('image');
        $file_uploaded_name = $file->getClientOriginalName();

        $api_url = 'http://api-uploadfile.test/api/file-upload';

        $client = new \GuzzleHttp\Client();

            $response = $client->request("POST", $api_url, [
                // jika menggunakan authorization
                // 'headers'        => ['Authorization' => 'Bearer access-token'],
                'multipart' => [
                    [
                        'name'      => 'file',
                        'filename' => $file_uploaded_name,
                        'Mime-Type'=> $file_mime,
                        'contents' => fopen($file_path, 'r'),
                    ],
                    [
                        'name'      => 'name',
                        'contents' => $request->name,
                    ],

                ]
            ]);

        $code   = $response->getStatusCode();
        $response   = $response->getBody();
        $responseData = json_decode($response, true);
        dd($responseData);
    }
}
