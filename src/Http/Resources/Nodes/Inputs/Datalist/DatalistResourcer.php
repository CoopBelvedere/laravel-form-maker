<?php

namespace Belvedere\FormMaker\Http\Resources\Nodes\Inputs\Datalist;

use Illuminate\Http\Resources\Json\JsonResource;
use Belvedere\FormMaker\Http\Resources\Nodes\NodeCollection;
use Belvedere\FormMaker\Contracts\Http\Resources\Nodes\Siblings\LabelResourcerContract;
use Belvedere\FormMaker\Contracts\Http\Resources\Nodes\Inputs\DatalistResourcerContract;

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
        $options = new NodeCollection($this->options());
        $label = $this->getLabelResource($inputId);

        return [
            'id' => $this->getKey(),
            'type' => $this->type,
            $this->mergeWhen($this->html_attributes, [
                'html_attributes' => [
                    'id' => $this->html_attributes['id'],
                ],
            ]),
            $this->mergeWhen(! is_null($label), [
                'label' => $label,
            ]),
            'input' => [
                'type' => 'list',
                'html_attributes' => array_merge($this->html_attributes, [
                    'id' => $inputId,
                    'list' => $this->html_attributes['id'],
                ]),
            ],
            $this->mergeWhen($options->count() > 0, [
                'options' => $options,
            ]),
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Get the label api resource.
     *
     * @param string $inputId
     * @return \Belvedere\FormMaker\Contracts\Http\Resources\Nodes\Siblings\LabelResourcerContract|null
     */
    protected function getLabelResource(string $inputId): ?LabelResourcerContract
    {
        if ($this->label) {
            return $this->label->withHtmlAttributes(['for' => $inputId])->toApi();
        }

        return $this->label;
    }
}
