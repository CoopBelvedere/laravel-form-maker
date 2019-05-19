<?php

namespace Belvedere\FormMaker\Traits\HtmlAttributes;

use Belvedere\FormMaker\Contracts\HtmlAttributes\HtmlAttributerContract;
use Illuminate\Support\Arr;

trait HasHtmlAttributes
{
    /**
     * Mass removal of html attributes to a model.
     *
     * @param array $attributes
     * @return self
     */
    public function removeHtmlAttributes(array $attributes): self
    {
        foreach ($attributes as $method => $arguments) {
            if (method_exists($this->htmlAttributesProvider, $method)) {
                $this->html_attributes = $this->htmlAttributesProvider->$method(null);
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
        foreach ($attributes as $method => $arguments) {
            if (method_exists($this->htmlAttributesProvider, $method)) {
                if ($method === $arguments) {
                    $this->html_attributes = $this->htmlAttributesProvider->$method();
                } else {
                    $this->html_attributes = $this->htmlAttributesProvider->$method(...Arr::wrap($arguments));
                }
            }
        }
        return $this;
    }
}