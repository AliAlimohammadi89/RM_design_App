<?php

namespace App\Http\Controllers\Api\V1\pages_type;

use App\Http\Controllers\Controller;

class ConvertHtml extends Controller
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
            $p = new ShopifyPageType($this->page_name);
        } else {
            return 'in coming';
        }
        $return = $this->get_page($page_value, $p->items_field);
        return $return;
    }

    public function get_page($page_html_value, $convert_tags)
    {
        $i = 0;
        foreach ($page_html_value as $name) {
            foreach ($convert_tags as $convert_tag_key => $convert_tag_value) {
                $page_html_value[$i] = str_replace($convert_tag_key, $convert_tag_value, $page_html_value[$i]);
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
}