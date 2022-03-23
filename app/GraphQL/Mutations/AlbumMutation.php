<?php

declare(strict_types=1);

namespace App\GraphQL\Mutations;

use App\Models\Album;
use Closure;
use Rebing\GraphQL\Support\Facades\GraphQL;
use GraphQL\Type\Definition\ResolveInfo;
use GraphQL\Type\Definition\Type;
use Rebing\GraphQL\Support\Mutation;
use Rebing\GraphQL\Support\SelectFields;

class AlbumMutation extends Mutation
{
    protected $attributes = [
        'name' => 'addAlbum',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Album');
    }

    public function args(): array
    {
        return [
            'title' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Album title',
                'rules' => ['max: 255', 'required']
            ],
            'description' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Album description',
                'rules' => ['string', 'required']
            ],
            'release' => [
                'type' => Type::nonNull(Type::string()),
                'description' => 'Album release date',
                'rules' => ['date', 'required']
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        return Album::create($args);
    }
}
