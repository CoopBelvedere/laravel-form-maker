<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Siblings;

use Belvedere\FormMaker\Contracts\Http\Resources\Nodes\Siblings\SiblingResourcerContract;
use Illuminate\Http\Resources\Json\JsonResource;

class SiblingResourcer extends JsonResource implements SiblingResourcerContract
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
            'id' => $this->getKey(),
            'type' => $this->type,
            $this->mergeWhen($this->text, [
                'text' => $this->text,
            ]),
            $this->mergeWhen($this->html_attributes, [
                'html_attributes' => $this->html_attributes,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
