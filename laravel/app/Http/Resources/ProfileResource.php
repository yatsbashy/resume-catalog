<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProfileResource extends JsonResource
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
            'picture_filename' => $this->picture_filename,
            'final_education' => $this->final_education,
            'github_url' => $this->github_url,
            'qiita_url' => $this->github_url,
            'specialty' => $this->specialty,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
