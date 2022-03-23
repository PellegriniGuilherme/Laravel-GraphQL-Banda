<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Lyric;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class LyricType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Lyric',
        'description' => 'A query the lyrics',
        'model' => Lyric::class
    ];

    public function fields(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::ID()),
                'description' => 'Song id'
            ],
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Song title'
            ],
            'lyric' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'lyrics'
            ],
            'language' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Language of music'
            ],
            'music_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Song Id'
            ]
        ];
    }
}
