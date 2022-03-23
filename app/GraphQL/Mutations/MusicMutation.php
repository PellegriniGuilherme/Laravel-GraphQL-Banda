<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Music;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class MusicMutation extends Mutation
{
    protected $attributes = [
        'name' => 'addMusic',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Music');
    }

    public function args(): array
    {
        return [
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Song title',
                'rules' => ['max: 255', 'required']
            ],
            'duration' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Song duration',
                'rules' => ['required', 'date_format:H:i']
            ],
            'composers' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Music composers',
                'rules' => ['required', 'max:255']
            ],
            'producers' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Music producers',
                'rules' => ['required', 'max:255']
            ],
            'album_id' => [
                'type' => Type::nonNull(Type::int()),
                'description' => 'Id of the album where the song was released',
                'rules' => ['integer', 'required', 'exists:albums,id']
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Music::create($args);
    }
}
