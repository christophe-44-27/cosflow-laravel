<?php

namespace App\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CosProjectPurchasedElementResource extends ResourceCollection
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
            'cos_project_purchased_elements' => $this->collection,
            'links' => [
                'self' => 'link-value',
            ],
        ];
    }
}
