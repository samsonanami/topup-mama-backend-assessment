<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Character extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'gender',
        'culture',
        'born',
        'died',
        'titles',
        'aliases',
        'father',
        'mother',
        'spouse',
        'allegiances',
        'books',
        'povBooks',
        'tvSeries',
        'playedBy',
    ];
    /**
     * Relationship
     */
}
