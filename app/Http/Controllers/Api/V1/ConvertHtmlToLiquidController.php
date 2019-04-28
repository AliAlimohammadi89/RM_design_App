<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Api\V1\pages_type\ConvertHtml;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConvertHtmlToLiquidController extends Controller
{
    /**
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function get_field(request $request){
        $file = new  ConvertHtml();
       // $file->getfile ($page_value,$page_type);
        $files = $request->file('uploads');
        $names=file($files);
        // echo count($names).'<br>';

      $p=  $file->getfile ($names,"collection");

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
