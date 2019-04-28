<?php

namespace App\Http\Controllers\Api\V1\pages_type;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ShopifyPageType extends Controller
{
    public function collectionPage()
    {
        $field = [
            '<PRODUCTS>' => '{% for product in collection.products    %}',
            '</PRODUCTS>' => '{% endfor  %}',
            '</PRODUCT_METAFIELD_ISNEWARRIVAL>' => '{{ product.metafields.specifications.isNewArrival }}',
            '</PRODUCT_COMPARE_PRICE>' => '{{ product.compare_at_price }}',
            '</PRODUCT_PRICE>' => '{{ product.price }}',
            '</PRODUCT_PRICE_MIN>' => '{{ product.price_min | money }}',
            '</PRODUCT_PRICE_MAX>' => ' {{product.price_max | money }}',
            '</PRODUCT_SALE>' => '{% if product.compare_at_price > product.price %}{{ product.compare_at_price | minus: product.price | times: 100.0 | divided_by: product.compare_at_price | money_without_currency | times: 100 | remove: ".0"}}%{% endif %} OFF</span>',
            '</PRODUCT_TITLE>' => '{{ product.title }}',
            '</PRODUCT_URL>' => '{{ product.url}}',
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
            '</PRODUCT_DESCRIPTION>' => '{{product.description}}'
        ];
        return $field;
    }

    public function page404()
    {
        $field = [
            '<404_PAGE_TITLE>' => "{{ 'general.404.title' | t }}",
            '<404_PAGE_SUB_TEXT>' => "{{ 'general.404.subtext_html' | t }}",
            '<404_ERROR_IMG>' => "{{ 'error-404.png' | asset_img_url: '800x'  }}",
        ];
        return $field;
    }

    public function articlepage()
    {
        $field = [
            '<ARTICLE_TITLE>' => "{{ article.title }}",
            '<ARTICLE_AUTHOR>' => "{{ article.author }}",
            '<ARTICLE_PUBLISHED>' => "{{ article.published_at | date: '%Y-%m-%d' }}",
            '<ARTICLE_CONTENT>' => "{{ article.content }}",
            '<ARTICLE_COMMENTS_COUNT>' => "{{ article.comments_count }}",
            '<ARTICLE_COMMENTS>' => "{% for comment in article.comments %}",
            '<ARTICLE_COMMENT_ID>' => "{{ comment.id }}",
            '<ARTICLE_COMMENT_AUTHOR>' => "{{ comment.author }}",
            '<ARTICLE_COMMENT_CREATE_AT>' => "{{ comment.created_at | date: format: 'month_day_year' }}",
            '<ARTICLE_COMMENTS>' => "{% for comment in article.comments %}",
            '</ARTICLE_COMMENTS>' => "{% endfor %}",
            '</ARTICLE_PAGINATE>' => "{{ paginate | default_pagination | replace: '&laquo; Previous', '&larr;' | replace: 'Next &raquo;', '&rarr;' }}",
            '<ARTICLE_FORM_COMMENT>' => "{% form 'new_comment', article %}",
            '<ARTICLE_FORM_COMMENT_TITLE>' => "{{ 'blogs.comments.title' | t }}",
            '<ARTICLE_FORM_COMMENT_ERROR>' => "{{ form.errors | default_errors }}",
            '<ARTICLE_FORM_COMMENT_NAME>' => "{{ 'blogs.comments.name' | t }}",
            '<ARTICLE_FORM_COMMENT_EMAIL>' => "{{ 'blogs.comments.email' | t }}",
            '<ARTICLE_FORM_COMMENT_EMAIL>' => "{{ 'blogs.comments.email' | t }}",
            '<ARTICLE_FORM_COMMENT_BODY>' => "{{ 'blogs.comments.message' | t }}",
            '<ARTICLE_FORM_COMMENT_POST_SUBMIT>' => "{{ 'blogs.comments.post' | t }}",
            '</ARTICLE_FORM_COMMENT>' => "{% endform %}",


        ];
    }
}
