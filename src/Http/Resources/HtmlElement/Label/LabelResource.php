<?php

namespace Belvedere\FormMaker\Http\Resources\HtmlElement\Label;

use Illuminate\Http\Resources\Json\JsonResource;

class LabelResource extends JsonResource
{
    /**
     * The id of the labelable form-related element.
     *
     * @var mixed
     */
    protected $forId = false;

    /**
     * The id of the form element with which the label is associated (its form owner).
     *
     * @var mixed
     */
    protected $formId = false;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $this->setForId();

        $this->setFormId();

        return [
            'id' => $this->id,
            'type' => $this->type,
            $this->mergeWhen($this->forId, [
                'for' => $this->forId,
            ]),
            $this->mergeWhen($this->formId, [
                'form' => $this->formId,
            ]),
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
     * Set the id of the labelable form-related element.
     *
     * @return void
     */
    protected function setForId(): void
    {
        if (isset($this->html_attributes['for'])) {
            $this->forId = $this->html_attributes['for'];

        } else if (isset($this->input()->html_attributes['id'])) {
            $this->forId = $this->input()->html_attributes['id'];
        }
    }

    /**
     * Set the id of the form element with which the label is associated.
     *
     * @return void
     */
    protected function setFormId(): void
    {
        if (isset($this->html_attributes['form'])) {
            $this->formId = $this->html_attributes['form'];

        } else if (isset($this->input()->form()->html_attributes['id'])) {
            $this->formId = $this->input()->form()->html_attributes['id'];
        }
    }
}