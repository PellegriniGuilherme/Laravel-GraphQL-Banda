<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Music;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class MusicQuery extends Query
{
    protected $attributes = [
        'name' => 'music',
        'description' => 'A query the songs'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Music');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::int(),
                'description' => 'Music id'
            ],
            'composers' => [
                'type' => Type::string(),
                'description' => 'Music composers'
            ],
            'producers' => [
                'type' => Type::string(),
                'description' => 'Music producers'
            ],
            'limit' => [
                'type' => Type::int(),
                'description' => 'Limit of data'
            ],
            'page' => [
                'type' => Type::int(),
                'description' => 'Page of data'
            ],
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        /** @var SelectFields $fields */
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $limit = 15;
        if(isset($args['limit'])){
            $limit = $args['limit'];
        }
        $page = 1;
        if(isset($args['page'])){
            $page = $args['page'];
        }

        if(isset($args['id'])){
            return Music::where('id', $args['id'])->paginate($limit, ['*'], 'page', $page);
        }

        return Music::with($with)->paginate($limit, ['*'], 'page', $page);
    }
}
