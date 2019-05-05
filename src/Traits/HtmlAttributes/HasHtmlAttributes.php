<?php

namespace Belvedere\FormMaker\Traits\HtmlAttributes;

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
            if (method_exists($this, $method)) {
                $this->$method(null);
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
     * Mass assign html attributes to a model.
     *
     * @param array $attributes
     * @return self
     */
    public function withHtmlAttributes(array $attributes): self
    {
        foreach ($attributes as $method => $arguments) {
            if (method_exists($this, $method)) {
                if ($method === $arguments) {
                    $this->$method();
                } else {
                    $this->$method(...Arr::wrap($arguments));
                }
            }
        }
        return $this;
    }
}