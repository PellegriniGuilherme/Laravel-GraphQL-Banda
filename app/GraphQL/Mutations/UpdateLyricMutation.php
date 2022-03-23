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

class UpdateLyricMutation extends Mutation
{
    protected $attributes = [
        'name' => 'updateLyric',
        'description' => 'A mutation'
    ];

    public function type(): Type
    {
        return GraphQL::type('Lyric');
    }

    public function args(): array
    {
        return [
            'id' => [
                'type' => Type::nonNull(Type::ID()),
                'description' => 'Album ID',
                'rules' => ['required', 'exists:lyrics,id']
            ],
            'title' => [
                'type' => Type::string(),
                'description' => 'Song title',
                'rules' => ['max: 255']
            ],
            'lyric' => [
                'type' => Type::string(),
                'description' => 'lyrics',
                'rules' => ['string']
            ],
            'language' => [
                'type' => Type::string(),
                'description' => 'Language of music',
                'rules' => ['string', 'max:5']
            ],
            'music_id' => [
                'type' => Type::int(),
                'description' => 'Song Id',
                'rules' => ['integer', 'exists:musics,id']
            ]
        ];
    }

    public function resolve($root, array $args, $context, ResolveInfo $resolveInfo, Closure $getSelectFields)
    {
        $fields = $getSelectFields();
        $select = $fields->getSelect();
        $with = $fields->getRelations();

        $lyric = Lyric::find($args['id']);
        if(isset($args['title'])){
            $lyric->title = $args['title'];
        }
        if(isset($args['lyric'])){
            $lyric->lyric = $args['lyric'];
        }
        if(isset($args['language'])){
            $lyric->language = $args['language'];
        }
        if(isset($args['music_id'])){
            $lyric->music_id = $args['music_id'];
        }

        $lyric->save();

        return $lyric;
    }
}
