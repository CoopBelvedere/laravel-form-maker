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
        $nodes = new NodeCollection($this->nodes() ?? collect([]));

        return [
            'id' => $this->id,
            'name' => $this->name,
            $this->mergeWhen($this->description, [
                'description' => $this->description,
            ]),
            $this->mergeWhen($this->html_attributes, [
                'html_attributes' => $this->html_attributes,
            ]),
            $this->mergeWhen(!is_null($nodes) && $nodes->count() > 0, [
                'nodes' => $nodes,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
