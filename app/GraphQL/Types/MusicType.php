<?php

declare(strict_types=1);

namespace App\GraphQL\Types;

use Rebing\GraphQL\Support\Type as GraphQLType;
use GraphQl;

class MusicType extends GraphQLType
{
    protected $attributes = [
        'name' => 'Music',
        'description' => 'A query the songs'
    ];

    public function fields(): array
    {
        return [

        ];
    }
}
