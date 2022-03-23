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
            'title' => [
                'type' => Type::string(),
                'description' => 'Music Title'
            ],
            'composers' => [
                'type' => Type::string(),
                'description' => 'Music composers'
            ],
            'producers' => [
                'type' => Type::string(),
                'description' => 'Music producers'
            ],
            'album_id' => [
                'type' => Type::int(),
                'description' => 'Album ID'
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


        return Music::select($select)
        ->where(function ($query) use ($args) {
            if(isset($args['id'])){
                $query->where('id', $args['id']);
            }

            if(isset($args['title'])){
                $query->where('title', $args['title']);
            }

            if(isset($args['composers'])){
                $query->where('composers', $args['composers']);
            }

            if(isset($args['producers'])){
                $query->where('producers', $args['producers']);
            }

            if(isset($args['album_id'])){
                $query->where('album_id', $args['album_id']);
            }
        })->paginate($limit, ['*'], 'page', $page);
    }
}
