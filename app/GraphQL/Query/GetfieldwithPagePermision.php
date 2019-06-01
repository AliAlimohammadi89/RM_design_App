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
        return GraphQL::paginate('GetfieldwithPagePermision');
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
            'page_name' =>[
                'type' => Type::string()

            ]


        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        $page_persitin = $args['page_name'] ?? 'product';
        $page = $args['page'] ?? 1;
        $limit = $args['limit'] ?? 10;
        $articles = Shopify_Converter ::where('Page_permission', '=', $page_persitin)->paginate($limit , '*' , 'page', $page);
        return $articles;
    }
}