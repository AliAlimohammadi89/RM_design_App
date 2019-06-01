<?php

namespace App\Http\Controllers;

use App\Shopify_Converter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Shopify_converterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function checkaddslashes($str)
    {
        if (strpos(str_replace("\'", "", " $str"), "'") != false)
            return addslashes($str);
        else
            return $str;
    }


    public function index()
    {


       // print_r($b);
      // dd($b,$field);

        $file_path = storage_path() . "\Book1.csv";
        $handle = fopen($file_path, "r");
        $header = true;
        print "<pre>";
        DB::table('shopify__converters')->delete();
        DB::table('Relationconvertor')->delete();
        while ($csvLine = fgetcsv($handle, 1000, ",")) {
            if(!isset($csvLine[0]) or $csvLine[0] == "")break;
            if ($header) {
                $header = false;
            } else {

                $parent_ids = explode(",", $csvLine[3]);

                // $parent_id =  DB::table('shopify__converters')->where('Parent_id', '2')->get();
                // dd($parent_id);

                $ar = array('‘', "'", '"', ",");
                $description = str_replace($ar, " ", $csvLine[6]);
                //$description = serialize($description);    # safe -- won't count the slash
                $description = addslashes($description);

                DB::table('shopify__converters')->insert([
                    'id' => $csvLine[0],
                    'Shop_key' => $csvLine[1],
                    'Shop_code' => $csvLine[2],
                    'Shop_description' => $description,
                    'is_for' => $csvLine[5],
                    'Parent_id' => 11,
                    'Page_permission' => $csvLine[4],
                ]);
                foreach ($parent_ids as $parent_id) {
                    DB::table('Relationconvertor')->insert([
                        'shopify__converters_id' => $csvLine[0],
                        'shopify__converters_parent_id' => $parent_id,
                    ]);

                }
            }
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Shopify_Converter $shopify_Converter
     * @return \Illuminate\Http\Response
     */
    public function show(Shopify_Converter $shopify_Converter)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Shopify_Converter $shopify_Converter
     * @return \Illuminate\Http\Response
     */
    public function edit(Shopify_Converter $shopify_Converter)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Shopify_Converter $shopify_Converter
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Shopify_Converter $shopify_Converter)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Shopify_Converter $shopify_Converter
     * @return \Illuminate\Http\Response
     */
    public function destroy(Shopify_Converter $shopify_Converter)
    {
        //
    }
}
