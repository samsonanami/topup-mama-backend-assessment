<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'name',
        'isbn',
        'authors',
        'character_id',
        'pov_character_id',
        'numberOfPages',
        'publisher',
        'country',
        'mediaType',
        'released'
    ];
    /**
     * Relationship
     */
    public function characters()
    {
        return $this->belongsToMany(Character::class, 'book_characters', 'book_id', 'character_id');
    }
    public function povCharacters()
    {
        return $this->belongsToMany(Character::class, 'book_pov_characters', 'character_id', 'book_id');
    }
    public function comments()
    {
        return $this->hasMany(Comment::class, 'id', 'comment_id');
    }
}
