<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class WorkResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'started_at' => $this->started_at,
            'ended_at' => $this->ended_at,
            'title' => $this->title,
            'description' => $this->description,
            'role' => $this->role,
            'scale' => $this->scale,
        ];
    }
}
