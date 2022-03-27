<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CharacterResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'name' => $this->name,
            'gender' => $this->gender,
            'culture' => $this->culture,
            'born' => $this->born,
            'died' => $this->died,
            'titles' => $this->titles,
            'aliases' => $this->aliases,
            'father' => $this->father,
            'mother' => $this->mother,
            'spouse' => $this->spouse,
            'allegiances' => $this->allegiances,
            'books' => $this->books,
            'povBooks' => $this->povBooks,
            'tvSeries' => $this->tvSeries,
            'playedBy' => $this->playedBy
        ];
    }
}
