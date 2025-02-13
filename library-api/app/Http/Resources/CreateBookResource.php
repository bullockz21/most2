<?php

namespace app\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
class CreateBookResource
{
    public function toArray($request)
    {
        return [
            'id'               => $this->id,
            'title'            => $this->title,
            'author'           => $this->author,
            'description'      => $this->description,
            'total_copies'     => $this->total_copies,
            'available_copies' => $this->available_copies,
            'created_at'       => $this->created_at,
            'updated_at'       => $this->updated_at,
        ];
    }
}
