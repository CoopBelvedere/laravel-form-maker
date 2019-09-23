<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Inputs\Datalist;

use Belvedere\FormMaker\{
    Contracts\Resources\DatalistResourcerContract,
    Http\Resources\Nodes\NodeCollection
};
use Illuminate\Http\Resources\Json\JsonResource;

class DatalistResourcer extends JsonResource implements DatalistResourcerContract
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $options = new NodeCollection($this->options());

        return [
            'id' => $this->id,
            'type' => $this->type,
            $this->mergeWhen($this->html_attributes, [
                'html_attributes' => $this->html_attributes,
            ]),
            'input' => [
                'id' => sprintf('input_%s', $this->id),
                'name' => $this->name,
            ],
            $this->mergeWhen($options->count() > 0, [
                'options' => $options,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}