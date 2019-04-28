<?php

namespace App\Http\Controllers\Api\V1\pages_type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConvertHtml extends Controller
{
    public function get_page($page_html_value,$convert_tags){
         $i=0;
        foreach($page_html_value as $name)
        {
            foreach ($convert_tags as $convert_tag_key=>$convert_tag_value){
                if (stripos($name, $convert_tag_key) !== false) {
                    $page_html_value[$i]="$convert_tag_value 
";
                }
            }
            $i++;
        }
        /* for create Liquid File

         $my_file = storage_path()."/".$page_type.".liquid";
        $handle = fopen($my_file, 'w') or die('Cannot open file:  '.$my_file);
        $data = implode(" ", $page_html_value);
        fwrite($handle, $data);

        */
        return $page_html_value;
    }
    public function getfile ($page_value,$page_type){
        if($page_type == "collection"){
            $p = new collectionPage();
            $fields = $p->replacce_tag();
            $return = $this->get_page($page_value,'collection',$fields);
        }
        return $return;
    }
}