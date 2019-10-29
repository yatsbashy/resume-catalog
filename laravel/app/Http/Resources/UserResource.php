<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $profile = $this->profile;

        return [
            'id' => $this->id,
            'name' => $this->name,
            'profile_picture_filename' => $profile ? $profile->picture_filename : null,
        ];
    }
}
