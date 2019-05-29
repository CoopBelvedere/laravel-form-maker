<?php

namespace Belvedere\FormMaker\Http\Resources\Sibling;

use Illuminate\Http\Resources\Json\ResourceCollection;

class SiblingCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->collection->transform(function ($sibling) {
            return $sibling->toApi();
        })->toArray();
    }
}
