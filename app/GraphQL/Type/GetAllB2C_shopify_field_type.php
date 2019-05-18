<?php


namespace App\GraphQL\Type;

use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;


class GetAllB2C_shopify_field_type extends GraphQLType
{
    protected $attributes = [
        'name' => 'GetAllB2C_shopify_type',
        'description' => 'A type'
    ];

    public function fields()
    {
        return [

            'id' => [
                'type' => Type::int()
            ],
            'Shop_key' => [
                'type' => Type::string()
            ],
            'Shop_code' => [
                'type' => Type::string()
            ],
            'Shop_description' => [
                'type' => Type::string()
            ],
            'Parent_id' => [
                'type' => Type::string()
            ],
            'Page_permission' => [
                'type' => Type::string()
            ],

        ];
    }
}