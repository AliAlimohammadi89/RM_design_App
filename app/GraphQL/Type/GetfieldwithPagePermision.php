<?php
namespace App\GraphQL\Type;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
class GetfieldwithPagePermision extends GraphQLType
{
    protected $attributes = [
        'name' => 'GetfieldwithPagePermision',
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
            'is_for'=> [
                'type' => Type::int()
            ],
            'Shop_code' => [
                'type' => Type::string()
            ],
            'Shop_description' => [
                'type' => Type::string()
            ],
            'Page_permission' => [
                'type' => Type::string()
            ],

        ];
    }
}