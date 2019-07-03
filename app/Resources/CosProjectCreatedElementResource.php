<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CosProjectCreatedElementResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'cos_project_created_elements' => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
