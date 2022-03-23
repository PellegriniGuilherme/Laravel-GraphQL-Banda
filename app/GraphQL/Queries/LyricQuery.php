<?php

declare(strict_types=1);

namespace App\GraphQL\Queries;

use App\Models\Lyric;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Query;
use Rebing\GraphQL\Support\SelectFields;

class LyricQuery extends Query
{
    protected $attributes = [
        'name' => 'lyric',
        'description' => 'A query the lyrics'
    ];

    public function type(): Type
    {
        return GraphQL::paginate('Lyric');
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
            'lyric' => [
                'type' => Type::string(),
                'description' => 'lyrics'
            ],
            'language' => [
                'type' => Type::string(),
                'description' => 'Language of music'
            ],
            'music_id' => [
                'type' => Type::int(),
                'description' => 'Song Id'
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
            return Lyric::where('id', $args['id'])->paginate($limit, ['*'], 'page', $page);
        }

        if(isset($args['title'])){
            return Lyric::where('title', $args['title'])->paginate($limit, ['*'], 'page', $page);
        }

        if(isset($args['lyric'])){
            return Lyric::where('lyric', $args['lyric'])->paginate($limit, ['*'], 'page', $page);
        }

        if(isset($args['language'])){
            return Lyric::where('language', $args['language'])->paginate($limit, ['*'], 'page', $page);
        }

        if(isset($args['music_id'])){
            return Lyric::where('music_id', $args['music_id'])->paginate($limit, ['*'], 'page', $page);
        }

        return Lyric::with($with)->paginate($limit, ['*'], 'page', $page);
    }
}
