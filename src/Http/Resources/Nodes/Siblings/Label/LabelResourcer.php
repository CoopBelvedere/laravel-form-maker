<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Siblings\Label;

use Illuminate\Http\Resources\Json\JsonResource;
use Belvedere\FormMaker\Contracts\Models\Form\FormContract;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\InputContract;
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
        if ($this->parent instanceof InputContract) {
            $attribute = 'for';
        } elseif ($this->parent instanceof FormContract) {
            $attribute = 'form';
        }

        $this->setForId($attribute);

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
     * @param string $attribute
     * @return void
     */
    protected function setForId(string $attribute): void
    {
        if (is_array($this->html_attributes) && array_key_exists($attribute, $this->html_attributes)) {
            return;
        }

        if (is_array($this->parent->html_attributes) && array_key_exists('id', $this->parent->html_attributes)) {
            $this->resource->withHtmlAttributes([$attribute => $this->parent->html_attributes['id']]);
        }
    }
}
