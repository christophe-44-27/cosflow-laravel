<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\Resource;

class UserProfileResource extends Resource
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
            'name' => $this->name,
            'avatar' => null,
            'email' => $this->email
        ];
    }
}
