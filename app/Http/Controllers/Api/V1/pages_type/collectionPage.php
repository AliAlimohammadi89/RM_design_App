<?php
/**
 * Created by PhpStorm.
 * User: allen
 * Date: 4/27/2019
 * Time: 12:36 PM
 */
namespace App\Http\Controllers\Api\V1\pages_type;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
class collectionPage extends Controller
{
    public function replacce_tag(){
                  $field=[
                '<PRODUCTS>' => '{% for product in collection.products    %}',
                '</PRODUCTS>' => '{% endfor  %}',
                '</PRODUCT_METAFIELD_ISNEWARRIVAL>' => '{{ product.metafields.specifications.isNewArrival }}',
                '</PRODUCT_COMPARE_PRICE>' => '{{ product.compare_at_price }}',
                '</PRODUCT_PRICE>' => '{{ product.price }}',
                '</PRODUCT_PRICE_MIN>' => '{{ product.price_min | money }}',
                '</PRODUCT_PRICE_MAX>' => ' {{product.price_max | money }}',
                '</PRODUCT_SALE>' => '{% if product.compare_at_price > product.price %}{{ product.compare_at_price | minus: product.price | times: 100.0 | divided_by: product.compare_at_price | money_without_currency | times: 100 | remove: ".0"}}%{% endif %} OFF</span>',
                '</PRODUCT_TITLE>' => '{{ product.title }}',
                '</PRODUCT_URL>' =>'{{ product.url}}',
                '</PRODUCT_ID>' => '{{ product.id }}',
                '</PRODUCT_IMG_SMALL>' => '{{ product.featured_image | product_img_url: "small" }}',
                '</PRODUCT_IMG_MEDIUM>' => '{{ product.featured_image | product_img_url: "medium" }}',
                '</PRODUCT_IMG_LARGE>' => '{{ product.featured_image | product_img_url: "large" }}',
                '</PRODUCT_IMG_ORIGINAL>' => '{{ product.featured_image | product_img_url: "original" }}',
                '</PRODUCT_IMG_DATALINK_THUMB>' => '{% assign image = product.metafields.images.all   %} {% assign images=image  | split: "," | reverse  %} {{images[0] | split: ".jpg" }}_T.jpg',
                '</PRODUCT_IMG_DATALINK_SMALL>' => '{% assign image = product.metafields.images.all   %} {% assign images=image  | split: "," | reverse  %} {{images[0] | split: ".jpg" }}_S.jpg',
                '</PRODUCT_IMG_DATALINK_ORIGINAL>' => '{% assign image = product.metafields.images.all   %} {% assign images=image  | split: "," | reverse  %} {{images[0] }}  ',
                '<PRODUCT_IMGS_DATALINK>' => '{% assign image_metafields = product.metafields.images.all   %} {% assign images=image_metafields  | split: "," | reverse  %}  {% for image in images %}',
                '</PRODUCT_IMGS_DATALINK>' => ' {% endfor %} ',
                '</PRODUCT_IMGS_DATALINK_ITEM_THUMB>' => '{{ image | remove :".jpg" |append : "_T.jpg"}}',
                '</PRODUCT_IMGS_DATALINK_ITEM_SMALL>' => '{{ image | remove :".jpg" |append : "_S.jpg"}}',
                '</PRODUCT_IMGS_DATALINK_ITEM_ORIGINAL>' => '{{ image }}',
                '</PRODUCT_DESCRIPTION>' =>'{{product.description}}'
        ];
        return $field;
    }

}