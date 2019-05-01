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
            $p = new ShopifyPageType();
        } else {
            return 'in coming';
        }

        switch ($this->page_name) {
            case 'collectionPage':
                $fields = $p->collectionPage();
                break;
            case 'page404':
                $fields = $p->page404();
                break;
            case 'articlePage':
                $fields = $p->articlePage();
                break;
            case 'blogPage':
                $fields = $p->blogPage();
                break;
            case 'cartPage':
                $fields = $p->cartPage();
                break;
            case 'customerAccount':
                $fields = $p->customer_account();
                break;
            case 'customerActiveAccount':
                $fields = $p->customer_active_account();
                break;
            case 'CustomerLogin':
                $fields = $p->customer_login();
                break;
            default:
                return 'no_page_find';
                break;
        }

        $return = $this->get_page($page_value, $fields);
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