<?php

namespace App\Modules\Features\C\Person\GraphQL\Type;

use GraphQL;
use App\Modules\Shared\GraphQL\Field\DateField;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;

class PersonType extends GraphQLType
{
    protected $attributes = [
        'name' => 'PersonType',
        'model' => \App\Modules\Features\C\Person\Models\Person::class
    ];

    public function fields()
    {
        return [
            'person_id' => [
            	'type' => Type::id()
            ],
            'person_identification' => [
            	'type' => Type::string()
            ],
            'person_first_name' => [
            	'type' => Type::string()
            ],
            'person_second_name' => [
            	'type' => Type::string()
            ],
            'person_first_surname' => [
            	'type' => Type::string()
            ],
            'person_second_surname' => [
            	'type' => Type::string()
            ],
            'person_legal_name' => [
                'type' => Type::string()
            ],
            'person_created_at' => DateField::class,
            'person_updated_at' => DateField::class,
            'person_deleted_at' => DateField::class,
            'type_person_id' => [
                'type' => Type::id()
            ],
            'type_person_identification_id' => [
                'type' => Type::id()
            ],
            'city_id' => [
                'type' => Type::id()
            ],
            /*In*/
            'type_person' => [
                'type' => GraphQL::type('TypePerson')
            ],
            'type_person_identification' => [
                'type' => GraphQL::type('TypePersonIdentification')
            ],
            'city' => [
                'type' => GraphQL::type('City')
            ],
            /*Out*/
            'user' => [
                'type' => GraphQL::type('User')
            ],
        ];
    }
}