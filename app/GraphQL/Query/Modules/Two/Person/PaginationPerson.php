<?php

namespace App\GraphQL\Query\Modules\Two\Person;

use GraphQL;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use App\Models\Modules\Two\Person;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;

class PaginationPerson extends Query
{
    protected $attributes = [
        'name' => 'PaginationPerson'
    ];

    public function type()
    {
        return GraphQL::paginate('Person');
    }

    public function args()
    {
        return [
            'person_id' => [
                'type' => Type::id()
            ],
            'person_identification' => [
                'type' => Type::string()
            ],
            'limit' => [
                'type' => Type::int()
            ],
            'page' => [
                'type' => Type::int()
            ],
        ];
    }

    public function resolve($root, $args, SelectFields $fields, ResolveInfo $info)
    {
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $person_id = isset($args['person_id']) ? $args['person_id'] : false;
        $person_identification = isset($args['person_identification']) ? $args['person_identification'] : false;

        $limit = isset($args['limit']) ? $args['limit'] : config('app.page_limit');
        $page = isset($args['page']) ? $args['page'] : 1;

        return Person::select($select)
                        ->when($person_id, function ($query) use ($person_id) {
                            return $query->where('person_id', '=', $person_id);
                        })
                        ->when($person_identification, function ($query) use ($person_identification) {
                            return $query->where('person_identification', '=', $person_identification);
                        })
                        ->with($with)
                        ->paginate($limit, ['*'], 'pages', $page);
    }
}