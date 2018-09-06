<?php

namespace App\GraphQL\Mutation\Modules\One\Estate;

use GraphQL;
use App\Models\One\Estate;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;

class StoreEstate extends Mutation
{
    protected $attributes = [
        'name' => 'StoreEstate'
    ];

    public function type()
    {
        return GraphQL::type('Estate');
    }

    public function args()
    {
        return [
            'estate_name' => [
                'type' => Type::string(),
                'rules' => ['required']
            ],
            'estate_code' => [
                'type' => Type::string(),
                'rules' => ['required']
            ],
            'country_id' => [
                'type' => Type::id(),
                'rules' => ['required']
            ]
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        return Estate::create($args);
    }
}