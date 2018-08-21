<?php

namespace App\GraphQL\Query\Modules\Two\User;

use GraphQL;
use App\Models\Modules\Two\User;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use GraphQL\Type\Definition\ResolveInfo;
use Rebing\GraphQL\Support\SelectFields;

class PaginationUser extends Query
{
    protected $attributes = [
        'name' => 'PaginationUser'
    ];

    public function type()
    {
        return GraphQL::paginate('User');
    }

    public function args()
    {
        return [
            'user_id' => [
                'type' => Type::int()
            ],
            'username' => [
                'type' => Type::string()
            ],
            'email' => [
                'type' => Type::string()
            ],
            'person_id' => [
                'type' => Type::int()
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

        $user_id = isset($args['user_id']) ? $args['user_id'] : false;
        $username = isset($args['username']) ? $args['username'] : false;
        $email = isset($args['email']) ? $args['email'] : false;
        $person_id = isset($args['person_id']) ? $args['person_id'] : false;

        $limit = isset($args['limit']) ? $args['limit'] : config('app.page_limit');
        $page = isset($args['page']) ? $args['page'] : 1;

        return User::select($select)
                        ->when($user_id, function ($query) use ($person_id) {
                            return $query->where('user_id', '=', $user_id);
                        })
                        ->when($username, function ($query) use ($username) {
                            return $query->where('username', 'like', '%'.$username.'%');
                        })
                        ->when($email, function ($query) use ($email) {
                            return $query->where('email', 'like', '%'.$email.'%');
                        })
                        ->when($person_id, function ($query) use ($person_id) {
                            return $query->where('person_id', '=', $person_id);
                        })
                        ->with($with)
                        ->paginate($limit, ['*'], 'pages', $page);
    }
}