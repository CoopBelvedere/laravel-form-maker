<?php

namespace Belvedere\FormMaker\Http\Resources\HtmlElement;

use Illuminate\Http\Resources\Json\JsonResource;

class ElementResourcer extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            $this->mergeWhen($this->text, [
                'text' => $this->text,
            ]),
            $this->mergeWhen($this->html_attributes, [
                'attributes' => $this->html_attributes,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
