<?php

namespace App\Http\Controllers\Api\V1;


use App\Http\Controllers\Api\V1\pages_type\ConvertHtml;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ConvertHtmlToB2CStoreController extends Controller
{


    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function get_field(request $request)
    {

        $b2c_type = $request->input('b2c_type', "Shopify");
        $page = $request->input('page', "pageSearch");
        $files = $request->input('uploads');
        $b2c_type = "Shopify";//for test
        $page = "pageSearch"; //for test
        $file = new  ConvertHtml($b2c_type, $page);

        // $fileget = file($files);
        $p = $file->getfile($files);
        //header("Location: C:/Users/allen/Desktop/tiny.html");
        //  return redirect()->away('C:/Users/allen/Desktop/tiny.html');
        // return $files;
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
