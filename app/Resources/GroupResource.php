<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\Resource;

class GroupResource extends Resource
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
            'group_code' => $this->group_code
        ];
    }
}
