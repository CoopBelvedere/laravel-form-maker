<?php

namespace Chess\FormMaker\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InputResource extends JsonResource
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

        return [
            'id' => $this->id,
            $this->mergeWhen($inputs && $inputs->collection->isNotEmpty(), [
                'inputs' => $inputs,
            ]),
            $this->mergeWhen($this->html_properties, [
                'properties' => $this->html_properties,
            ]),
            'type' => $this->type,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
