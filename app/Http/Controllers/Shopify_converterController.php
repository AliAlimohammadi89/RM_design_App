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
    public function index()
    {
        die;
        $file_path = storage_path() . "\Book1.csv";
        $handle = fopen($file_path, "r");
        $header = true;
        print "<pre>";
        while ($csvLine = fgetcsv($handle, 1000, ",")) {
            if ($header) {
                $header = false;
            } else {

              //  print str_replace('�'," ",$csvLine[6]);

//                DB::insert('insert into shopify__converters (Shop_key, Shop_code,Shop_description,is_for,Parent_id,Page_permission) values (?,?,?,?,?,)', array($csvLine[1],$csvLine[2],$csvLine[6],$csvLine[5],$csvLine[3],$csvLine[4],));


                DB::table('shopify__converters')->insert([
                    'Shop_key' => $csvLine[1],
                    'Shop_code' => $csvLine[2],
                    'Shop_description' =>  $csvLine[6],
                    'is_for' => $csvLine[5],
                    'Parent_id' => $csvLine[3],
                    'Page_permission' => $csvLine[4],
                ]);
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
