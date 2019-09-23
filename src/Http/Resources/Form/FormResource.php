<?php

namespace Belvedere\FormMaker\Http\Resources\Form;

use Belvedere\FormMaker\Http\Resources\Nodes\NodeCollection;
use Illuminate\Http\Resources\Json\JsonResource;

class FormResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $nodes = new NodeCollection($this->nodes());

        return [
            'id' => $this->id,
            $this->mergeWhen($this->description, [
                'description' => $this->description,
            ]),
            $this->mergeWhen($nodes->collection->isNotEmpty(), [
                'nodes' => $nodes,
            ]),
            $this->mergeWhen($this->html_attributes, [
                'html_attributes' => $this->html_attributes,
            ]),
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
