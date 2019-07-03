<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CosProjectElementResource extends JsonResource
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
            'elementable_type' => $this->elementable_type,
            'elementable_id' => $this->elementable_id
        ];
    }
}
