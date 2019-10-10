<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Siblings\Label;

use Illuminate\Http\Resources\Json\JsonResource;
use Belvedere\FormMaker\Contracts\Http\Resources\Nodes\Siblings\LabelResourcerContract;

class LabelResourcer extends JsonResource implements LabelResourcerContract
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $this->setForId();

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

    /**
     * Get the id of the parent model.
     *
     * @return void
     */
    protected function setForId(): void
    {
        $attribute = $this->parent->getLabelableAttributeName();

        if (is_array($this->html_attributes) && array_key_exists($attribute, $this->html_attributes)) {
            return;
        }

        if (is_array($this->parent->html_attributes) && array_key_exists('id', $this->parent->html_attributes)) {
            $this->resource->withHtmlAttributes([$attribute => $this->parent->html_attributes['id']]);
        }
    }
}
