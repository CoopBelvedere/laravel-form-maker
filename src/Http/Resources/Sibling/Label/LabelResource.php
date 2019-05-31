<?php

namespace Belvedere\FormMaker\Http\Resources\Sibling\Label;

use Belvedere\FormMaker\Contracts\Form\FormContract;
use Belvedere\FormMaker\Contracts\Inputs\InputContract;
use Illuminate\Http\Resources\Json\JsonResource;

class LabelResource extends JsonResource
{
    /**
     * The id of the labelable form-related element.
     *
     * @var mixed
     */
    protected $forId;

    /**
     * The id of the form element with which the label is associated (its form owner).
     *
     * @var mixed
     */
    protected $formId;

    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request): array
    {
        $this->setParentId();

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
     * Get the id of the parent model.
     *
     * @param string $attribute
     * @return bool|string
     */
    protected function getId(string $attribute)
    {
        if (is_array($this->html_attributes) && array_key_exists($attribute, $this->html_attributes)) {
            return $this->html_attributes[$attribute];
        }

        if (is_array($this->parent->html_attributes) && array_key_exists('id', $this->parent->html_attributes)) {
            return $this->parent->html_attributes['id'];
        }

        return false;
    }

    /**
     * Set the parent id attribute for the label.
     *
     * @return void
     */
    protected function setParentId(): void
    {
        if ($this->parent instanceof InputContract) {
            $this->forId = $this->getId('for');
        } else if ($this->parent instanceof FormContract) {
            $this->formId = $this->getId('form');
        }
    }
}