<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Inputs;

use Belvedere\FormMaker\{
    Contracts\Resources\InputResourcerContract,
    Http\Resources\Nodes\Siblings\SiblingCollection
};
use Illuminate\Http\Resources\Json\JsonResource;

class InputResourcer extends JsonResource implements InputResourcerContract
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        if ($inputs = method_exists($this->resource, 'inputs')) {
            $inputs = new InputCollection($this->inputs());
        } else if ($options = method_exists($this->resource, 'options')) {
            $options = new InputCollection($this->options()->get());
        }

        $siblings = new SiblingCollection($this->siblings());

        return [
            'id' => $this->id,
            'type' => $this->type,
            $this->mergeWhen($this->text, [
                'text' => $this->text,
            ]),
            $this->mergeWhen($this->html_attributes, [
                'html_attributes' => $this->html_attributes,
            ]),
            $this->mergeWhen($inputs && $inputs->collection->isNotEmpty(), [
                'inputs' => $inputs,
            ]),
            $this->mergeWhen($options && $options->collection->isNotEmpty(), [
                'options' => $options,
            ]),
            $this->mergeWhen($siblings->collection->isNotEmpty(), [
                'siblings' => $siblings,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
