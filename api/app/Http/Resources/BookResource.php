<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'isbn' => $this->isbn,
            'authors' => $this->authors,
            'character_id' => $this->character_id,
            'pov_character_id' => $this->pov_character_id,
            'numberOfPages' => $this->numberOfPages,
            'publisher' => $this->publisher,
            'country' => $this->country,
            'mediaType' => $this->mediaType,
            'released' => $this->released,
            'comment_count' => count($this->comments),
            'povCharacters'=>$this->povCharacters,
            'characters'=>$this->characters,
            'comments'=>$this->comments,
        ];
    }
}
