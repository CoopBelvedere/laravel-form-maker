<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Inputs;

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
            return $input->toApi();
        })->toArray();
    }
}
