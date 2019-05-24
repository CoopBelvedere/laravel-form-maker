<?php

namespace Belvedere\FormMaker\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InputResourcer extends JsonResource
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
        }

        if ($options = method_exists($this->resource, 'options')) {
            $options = new InputCollection($this->options()->get());
        }

        return [
            'id' => $this->id,
            'type' => $this->type,
            $this->mergeWhen($this->text, [
                'text' => $this->text,
            ]),
            $this->mergeWhen($this->html_attributes, [
                'attributes' => $this->html_attributes,
            ]),
            $this->mergeWhen($inputs && $inputs->collection->isNotEmpty(), [
                'inputs' => $inputs,
            ]),
            $this->mergeWhen($options && $options->collection->isNotEmpty(), [
                'options' => $options,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
