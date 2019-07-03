<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\Resource;

class CosProjectResource extends Resource
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
            'character_name' => $this->character_name,
            'serie_name' => $this->serie_name,
            'image_project' => $this->image_project,
            'estimated_budget' => $this->estimated_budget,
            'starting_date' => $this->starting_date,
            'due_date' => $this->due_date,
            'is_planned' => $this->is_planned,
            'is_processing' => $this->is_processing,
            'is_private' => $this->is_private,
            'owner_id' => $this->owner_id,
        ];
    }
}
