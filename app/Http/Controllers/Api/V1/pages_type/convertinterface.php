<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

interface  Convert_html{
    public function __construct($b2cType,$page);//get page type
}
interface  Convert_html_b2c{
    public function __construct($page);//get page type
}