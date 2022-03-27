<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookPovCharacters extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    public $table = "book_pov_characters";

    protected $fillable = [
        'book_id',
        'character_id'
    ];
}
