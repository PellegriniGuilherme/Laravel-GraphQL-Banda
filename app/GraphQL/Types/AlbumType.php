<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use App\Models\Album;
use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Facades\GraphQL;

class AlbumType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Album',
        'description' => 'A query the albums',
        'model' => Album::class
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
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Album description'
            ],
            'release' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Album release date'
            ],
            'musics' => [
                'type' => Type::listOf(GraphQL::type('Music')),
                'description' => 'Musics of the album'
            ]
        ];
    }
}
