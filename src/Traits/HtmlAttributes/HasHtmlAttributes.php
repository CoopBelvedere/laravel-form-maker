<?php

namespace Belvedere\FormMaker\Traits\HtmlAttributes;

use Belvedere\FormMaker\Contracts\HtmlAttributes\HtmlAttributerContract;
use Illuminate\Support\Arr;

trait HasHtmlAttributes
{
    /**
     * The current implementation of the HtmlAttributerContract
     *
     * @var mixed
     */
    protected $htmlAttributesProvider;

    /**
     * Mass removal of html attributes to a model.
     *
     * @param array $attributes
     * @return self
     */
    public function removeHtmlAttributes(array $attributes): self
    {
        foreach ($attributes as $attribute => $arguments) {
            if ($this->isValidAttribute($attribute)) {
                $this->html_attributes = $this->htmlAttributesProvider->$attribute(null);
            }
        }
        return $this;
    }

    /**
     * Set the model html attributes.
     *
     * @param  array $attributes
     * @return void
     */
    public function setHtmlAttributesAttribute(array $attributes): void
    {
        if (isset($this->attributes['html_attributes'])) {
            $attributes = array_filter(array_merge($this->html_attributes, $attributes), function ($attribute) {
                return !is_null($attribute);
            });
        }
        $this->attributes['html_attributes'] = json_encode($attributes);
    }

    /**
     * Set the html attributes provider used by the model.
     *
     * @return void
     */
    public function setHtmlAttributesProvider(): void
    {
        $this->htmlAttributesProvider = resolve(HtmlAttributerContract::class);
    }

    /**
     * Mass assign html attributes to a model.
     *
     * @param array $attributes
     * @return self
     */
    public function withHtmlAttributes(array $attributes): self
    {
        foreach ($attributes as $attribute => $arguments) {
            if ($this->isValidAttribute($attribute)) {
                if (is_null($arguments)) {
                    $this->html_attributes = $this->htmlAttributesProvider->$attribute(null);
                } else if ($attribute === $arguments) {
                    $this->html_attributes = $this->htmlAttributesProvider->$attribute();
                } else {
                    $this->html_attributes = $this->htmlAttributesProvider->$attribute(...Arr::wrap($arguments));
                }
            }
        }
        return $this;
    }

    /**
     * Check if the attribute is valid for the model.
     *
     * @param string $attribute
     * @return bool
     */
    protected function isValidAttribute(string $attribute): bool
    {
        return in_array($attribute, $this->htmlAttributesAvailable)
            && method_exists($this->htmlAttributesProvider, $attribute);
    }
}