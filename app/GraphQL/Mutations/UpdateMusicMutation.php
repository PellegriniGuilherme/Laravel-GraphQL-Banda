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

class UpdateMusicMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateMusic',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Music');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::ID()),
                'description' => 'Album ID',
                'rules' => ['exists:albums,id']
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Song title',
                'rules' => ['max: 255']
            ],
            'duration' => [
                'type' => Type::string(),
                'description' => 'Song duration',
                'rules' => ['date_format:H:i']
            ],
            'composers' => [
                'type' => Type::string(),
                'description' => 'Music composers',
                'rules' => ['max:255']
            ],
            'producers' => [
                'type' => Type::string(),
                'description' => 'Music producers',
                'rules' => ['max:255']
            ],
            'album_id' => [
                'type' => Type::int(),
                'description' => 'Id of the album where the song was released',
                'rules' => ['integer', 'exists:albums,id']
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $music = Music::find($args['id']);

        if(isset($args['title'])){
            $music->title = $args['title'];
        }
        if(isset($args['duration'])){
            $music->duration = $args['duration'];
        }
        if(isset($args['composers'])){
            $music->composers = $args['composers'];
        }
        if(isset($args['producers'])){
            $music->producers = $args['producers'];
        }
        if(isset($args['album_id'])){
            $music->album_id = $args['album_id'];
        }

        $music->save();

        return $music;
    }
}
