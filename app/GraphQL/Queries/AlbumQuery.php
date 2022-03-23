<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Album;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class AlbumQuery extends Query
{
    protected $attributes = [
        'name' => 'album',
        'description' => 'A query the albums'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Album');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::ID(),
                'description' => 'Song id'
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Song title'
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Album description'
            ],
            'release' => [
                'type' => Type::string(),
                'description' => 'Album release date'
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

        
        return Album::select($select)
        ->where(function ($query) use ($args) {
            if(isset($args['id'])){
                $query->where('id', $args['id']);
            }
    
            if(isset($args['title'])){
                $query->where('title', $args['title']);
            }
    
            if(isset($args['description'])){
                $query->where('description', $args['description']);
            }
    
            if(isset($args['release'])){
                $query->where('release', $args['release']);
            }
        })->paginate($limit, ['*'], 'page', $page);
    }
}
