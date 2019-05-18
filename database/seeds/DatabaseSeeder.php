<?php

use Illuminate\Database\Seeder;
use Faker\Generator as Faker;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
       // $faker = new Faker()::create;
       //  $faker = Faker::create();
        $field = [
            '-COLLECTION_LIST_COLLECTIONS' => "{% for collection in collections %}",
            'COLLECTION_LIST_COLLECTION_URL' => "{{collection.url | 'url'}}",
            'COLLECTION_LIST_COLLECTION_TITLE' => "{{collection.title}}",
            '-COLLECTION_LIST_COLLECTION_PRODUCTS' => "{% for product in collection.products  limit :5%}",
            '-COLLECTION_LIST_COLLECTION_PRODUCT_URL' => "{{product.url}}",
            '-COLLECTION_LIST_COLLECTION_PRODUCT_IMG' => "{% if product.metafields.images.all %}{% assign images = product.metafields.images.all | split: ',' | reverse  %}{% assign image = images[0] | split: '.jpg' %}{{image}}_S.jpg  {%else%}{{ product.featured_image | product_img_url: 'medium' }}{% endif %}",
            '-COLLECTION_LIST_COLLECTION_PRODUCT_TITLE' => "{{product.title}}",
            '-COLLECTION_LIST_COLLECTION_PRODUCT_PRICE' => "{%- if product.price_min  == product.price_max  -%}{{ product.price_min | money }}{% else %}{{ product.price_min | money }} - {{product.price_max | money }}{% endif %}",
            '-COLLECTION_LIST_COLLECTION_PRODUCT_SAIL' => "{% if product.compare_at_price > product.price %}{{ product.compare_at_price | minus: product.price | times: 100.0 | divided_by: product.compare_at_price | money_without_currency | times: 100 | remove: '.0'}}%{% endif %} OFF",
            '-COLLECTION_LIST_COLLECTION_PAGINATE' => "  {% if paginate.pages > 1 %} {{ paginate | default_pagination }} {% endif %} ",
            'END_FORM' => "{% endform %}",
            'ENDIF' => "{% endif %}  ",
            'ENDFOR' => "{% endfor %}  ",
            'FOR_INDEX' => "{{forloop.index}}",
        ];
        // $this->call(UsersTableSeeder::class);
        foreach ($field as $key => $value){

            DB::table('shopify_converters')->insert([
                'shop_key' => $key,
                'Shop_code' => $value,
                'Shop_description' =>str_replace('_'," ",$key),

                'Parent_id' => 1,
                'Page_permission' => 0,

            ]);
        }

    }
}
