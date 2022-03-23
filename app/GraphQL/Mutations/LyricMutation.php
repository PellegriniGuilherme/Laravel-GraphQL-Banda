<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Lyric;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class LyricMutation extends Mutation
{
    protected $attributes = [
        'name' => 'addLyric',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Lyric');
    }

    public function args(): array
    {
        return [
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Song title',
                'rules' => ['max: 255', 'required']
            ],
            'lyric' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'lyrics',
                'rules' => ['string', 'required']
            ],
            'language' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Language of music',
                'rules' => ['string', 'required', 'max:5']
            ],
            'music_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Song Id',
                'rules' => ['integer', 'required', 'exists:musics,id']
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Lyric::create($args);
    }
}
