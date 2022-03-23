<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Music;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Type as GraphQLType;
use Rebing\GraphQL\Support\Facades\GraphQL;
class MusicType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Music',
        'description' => 'A query the songs',
        'model' => Music::class
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
            'composers' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Music composers'
            ],
            'producers' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Music producers'
            ],
            'album_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of the album where the song was released'
            ],
            'lyrics' => [
                'type' => Type::listOf(GraphQL::type('Lyric')),
                'description' => 'Lyrics of the song'
            ]
        ];
    }
}
