<?php

namespace Belvedere\FormMaker\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class InputCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->collection->transform(function ($input) {
            return new InputResource($input);
        })->toArray();
    }
}
