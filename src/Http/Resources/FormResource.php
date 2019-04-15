<?php

namespace Chess\FormMaker\Http\Resources;

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
        $inputs = new InputCollection($this->inputs());

        return [
            'id' => $this->id,
            $this->mergeWhen($this->description, [
                'description' => $this->description,
            ]),
            $this->mergeWhen($inputs->collection->isNotEmpty(), [
                'inputs' => $inputs,
            ]),
            $this->mergeWhen($this->html_properties, [
                'properties' => $this->html_properties,
            ]),
            'title' => $this->title,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
