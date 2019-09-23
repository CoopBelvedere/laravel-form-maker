<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Inputs\Datalist;

use Belvedere\FormMaker\{
    Contracts\Resources\DatalistResourcerContract,
    Http\Resources\Nodes\NodeCollection
};
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
        $inputListId = uniqid('list_');
        $options = new NodeCollection($this->options()->collect());
        $siblings = new NodeCollection($this->setLabelsInList($inputListId));

        return [
            'id' => $this->getKey(),
            'type' => $this->type,
            $this->mergeWhen($this->html_attributes, [
                'html_attributes' => [
                    'id' => $this->html_attributes['id']
                ],
            ]),
            'input' => [
                'type' => 'list',
                'html_attributes' => array_merge($this->html_attributes, [
                    'id' => $inputListId,
                    'list' => $this->html_attributes['id']
                ]),
            ],
            $this->mergeWhen($options->count() > 0, [
                'options' => $options,
            ]),
            $this->mergeWhen($siblings->count() > 0, [
                'siblings' => $siblings,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Set the label id in the siblings list.
     *
     * @param string $inputId
     * @return \Illuminate\Support\Collection
     */
    protected function setLabelsInList(string $inputId): Collection
    {
        return $this->siblings()->map(function ($node, $key) use ($inputId) {
            if ($node->type === 'label') {
                $node->withHtmlAttributes(['for' => $inputId]);
            }
            return $node;
        })->collect();
    }
}