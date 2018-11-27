<?php

namespace App\Modules\Features\C\User\GraphQL\Type;

use GraphQL;
use App\Modules\Shared\GraphQL\Field\DateField;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class UserType extends GraphQLType
{
    protected $attributes = [
        'name' => 'UserType',
        'model' => \App\Modules\Features\C\User\Models\User::class
    ];

    public function fields()
    {
        return [
            'user_id' => [
            	'type' => Type::id()
            ],
            'username' => [
            	'type' => Type::string()
            ],
            'email' => [
            	'type' => Type::string()
            ],
            'password' => [
            	'type' => Type::string()
            ],
            'remember_token' => [
            	'type' => Type::string()
            ],
            'user_created_at' => DateField::class,
            'user_updated_at' => DateField::class,
            'user_deleted_at' => DateField::class,
            'person_id' => [
                'type' => Type::id()
            ],
            'profile_id' => [
                'type' => Type::id()
            ],
            /*In*/
            'person' => [
                'type' => GraphQL::type('Person')
            ],
            'profile' => [
                'type' => GraphQL::type('Profile')
            ],
        ];
    }
}