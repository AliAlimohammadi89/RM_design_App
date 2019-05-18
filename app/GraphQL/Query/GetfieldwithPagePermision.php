<?php

namespace App\GraphQL\Query;



use App\Convertor;
use App\Shopify_Converter;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

use Illuminate\Support\Facades\DB;
use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class GetfieldwithPagePermision extends Query
{
    protected $attributes = [
        'name' => 'GetfieldwithPagePermision',
        'description' => 'A query'
    ];

    public function type()
    {
        return GraphQL::paginate('GetAllB2C_shopify_field_type');
    }
    public function args()
    {
        return [
            'page' => [
                'type' => Type::int()
            ],
            'limit' => [
                'type' => Type::int()
            ],
            'page_persitin' =>[
                'type' => Type::int()

            ]


        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        $page_persitin = $args['page_persitin'] ?? 1;
        $page = $args['page'] ?? 1;
        $limit = $args['limit'] ?? 10;
        $articles = Shopify_Converter ::where('id', '<', $page_persitin)->paginate($limit , ['id'] , 'page', $page);
        return $articles;
    }
}