<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Inputs;

use Belvedere\FormMaker\{
    Contracts\Resources\InputResourcerContract,
    Http\Resources\Nodes\NodeCollection
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
        if ($options = method_exists($this->resource, 'options')) {
            $options = new NodeCollection($this->options()->collect());
        }

        $label = $this->label();

        return [
            'id' => $this->getKey(),
            'type' => $this->type,
            $this->mergeWhen($this->text, [
                'text' => $this->text,
            ]),
            $this->mergeWhen($this->html_attributes, [
                'html_attributes' => $this->html_attributes,
            ]),
            $this->mergeWhen($label, [
                'label' => $label->toApi(),
            ]),
            $this->mergeWhen($options && $options->count() > 0, [
                'options' => $options,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
