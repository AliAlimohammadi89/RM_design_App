<?php
namespace App\GraphQL\Query;



use App\Convertor;
use App\Shopify_Converter;
use GraphQL;
use GraphQL\Type\Definition\Type;
use GraphQL\Type\Definition\ResolveInfo;

use Rebing\GraphQL\Support\SelectFields;
use Rebing\GraphQL\Support\Query;

class Getchilditem extends Query
{
    protected $attributes = [
        'name' => 'GetParentItem',
        'description' => 'A query for Get Childes in item if send 29 get 2,4,6,42,.... '
    ];

    public function type()
    {
        // return GraphQL::string('GetfieldwithPagePermision');
        return GraphQL::paginate('GetfieldwithPagePermision');
        return Type::paginate(\GraphQL::type('GetfieldwithPagePermision'));
//get child item
        // return GraphQL::paginate('GetfieldwithPagePermision');
    }
    public function args()
    {
        return [
            'page' => [
                'type' => Type::int(),
                'description'=> 'Number of page'
            ],
            'limit' => [
                'type' => Type::int()
            ],
            'Parent_id' => [
                'type' => Type::id()

            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $select = $fields->getSelect();
        $with = $fields->getRelations();
        $Parent_id = $args['Parent_id'] ?? 1;
        $page = $args['page'] ?? 1;
        $limit = $args['limit'] ?? 10;
        $articles = Shopify_Converter ::where('Relationconvertor.shopify__converters_parent_id', '=', $Parent_id)
            ->join('Relationconvertor', 'shopify__converters.id', '=', 'Relationconvertor.shopify__converters_id')
            ->paginate($limit , 'shopify__converters.*' , 'page', $page)
        ;
        return $articles;

    }
}