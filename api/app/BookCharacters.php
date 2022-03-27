<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookCharacters extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "book_characters";

    protected $fillable = [
        'book_id',
        'character_id'
    ];
}
