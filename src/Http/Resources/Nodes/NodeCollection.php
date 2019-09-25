<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes;

use Illuminate\Http\Resources\Json\ResourceCollection;

class NodeCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->collection->transform(function ($node) {
            return $node->toApi();
        })->toArray();
    }
}
