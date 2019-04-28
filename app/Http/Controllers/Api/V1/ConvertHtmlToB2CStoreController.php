<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\V1\pages_type\ConvertHtml;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConvertHtmlToB2CStoreController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function get_field(request $request)
    {
        $b2c_type = $request->input('b2c_type');
        $page = $request->input('page');
        $file = new  ConvertHtml($b2c_type, $page);
        $files = $request->file('uploads');
        $fileget = file($files);
        $p = $file->getfile($fileget);
        return json_encode($p);
        //for crate download link ----------------------
        // $file_path="collection.liquid";
        //  $filename="collection.liquid";

        //   $file_path = storage_path() ."\\". $filename;
        // return $p;
        // return $filename;
//      //  $headers = array(
//            'Content-Type' => 'application/csv',
//            'Content-Disposition' => 'attachment; filename=' . $filename,
//        );
        //return \Response::download( $file_path, $filename, $headers );

    }
}
