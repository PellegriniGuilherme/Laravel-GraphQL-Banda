<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    use HasFactory;

    protected $table = 'albums';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'release',
        'title',
        'description',
        'cover'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'release' => 'date:Y-m-d',
        'title' => 'string',
        'description' => 'string'
    ];

    public function musics()
    {
        return $this->hasMany(Music::class);
    }
}
