<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Inputs\Datalist;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DatalistCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return $this->collection->transform(function ($datalist) {
            return $datalist->toApi();
        })->toArray();
    }
}