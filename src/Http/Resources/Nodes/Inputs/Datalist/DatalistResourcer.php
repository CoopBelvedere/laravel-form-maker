<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Inputs\Datalist;

use Belvedere\FormMaker\{Contracts\Resources\DatalistResourcerContract,
    Contracts\Siblings\Label\LabelerContract,
    Http\Resources\Nodes\NodeCollection};
use Illuminate\{
    Http\Resources\Json\JsonResource,
    Support\Collection
};

class DatalistResourcer extends JsonResource implements DatalistResourcerContract
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $inputId = uniqid('list_');
        $options = new NodeCollection($this->options()->collect());
        $label = $this->label();
        
        return [
            'id' => $this->getKey(),
            'type' => $this->type,
            $this->mergeWhen($this->html_attributes, [
                'html_attributes' => [
                    'id' => $this->html_attributes['id']
                ],
            ]),
            $this->mergeWhen(!is_null($label), [
                'label' => $label->withHtmlAttributes(['for' => $inputId])->toApi(),
            ]),
            'input' => [
                'type' => 'list',
                'html_attributes' => array_merge($this->html_attributes, [
                    'id' => $inputId,
                    'list' => $this->html_attributes['id']
                ]),
            ],
            $this->mergeWhen($options->count() > 0, [
                'options' => $options,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}