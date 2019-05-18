<?php

namespace App\Http\Controllers\Api\V1\pages_type;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Convert_html;
use Mustache_Engine;

class ConvertHtml extends Controller implements Convert_html
{
    protected $b2cType;
    protected $page_name;

    function __construct($b2cType, $page_name)
    {
        $this->b2cType = $b2cType;
        $this->page_name = $page_name;
    }

    public function getfile($page_value)
    {
        if ($this->b2cType == 'Shopify') {
            $B2C = new ShopifyPageType( $this->page_name);

        } else {
            return 'in coming';
        }
            
        $return = $this->get_page($page_value, $B2C->items_field,$B2C->items_local_page_name);
        return $return;
    }


    public function get_page($page_html_value, $convert_tags,$pageurl)
    {

        $page_html_value = htmlspecialchars_decode($page_html_value, ENT_QUOTES);
        $m = new Mustache_Engine;
        $page_html_value = $m->render($page_html_value, $convert_tags); // "Hello World!"
        $page_html_value = htmlspecialchars_decode($page_html_value);
        $my_file = storage_path() . "/Shopify_theme/templates/" .$pageurl . ".liquid";
        $handle = fopen($my_file, 'w') or die('Cannot open file:  ' . $my_file);
        //$data = implode(" ", $page_html_value);
        fwrite($handle, $page_html_value);
        return $page_html_value;
    }
}