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

class UpdateAlbumMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateAlbum',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Album');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::ID()),
                'description' => 'Album ID',
                'rules' => ['required', 'exists:albums,id']
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Album title',
                'rules' => ['max: 255']
            ],
            'description' => [
                'type' => Type::string(),
                'description' => 'Album description',
                'rules' => ['string']
            ],
            'release' => [
                'type' => Type::string(),
                'description' => 'Album release date',
                'rules' => ['date']
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $album = Album::find($args['id']);
        if(isset($args['title'])){
            $album->title = $args['title'];
        }
        if(isset($args['description'])){
            $album->description = $args['description'];
        }
        if(isset($args['release'])){
            $album->release = $args['release'];
        }

        $album->save();

        return $album;
    }
}
