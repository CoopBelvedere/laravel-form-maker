<?php

namespace Belvedere\FormMaker\Http\Resources\Form;

use Belvedere\FormMaker\Http\Resources\Input\InputCollection;
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
            $this->mergeWhen($this->html_attributes, [
                'attributes' => $this->html_attributes,
            ]),
            'name' => $this->name,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
