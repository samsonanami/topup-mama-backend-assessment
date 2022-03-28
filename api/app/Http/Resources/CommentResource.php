<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'book_id' => $this->book_id,
            'comment' => $this->comment,
            'commenter_ip' => $this->commenter_ip,
            'created_at' => $this->created_at,
        ];
    }
}
