<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    
    public $table = "comments";

    protected $fillable = [
        'book_id',
        'comment',
        'commenter_ip'
    ];
}
