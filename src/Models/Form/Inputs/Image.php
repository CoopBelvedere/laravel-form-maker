<?php

namespace Chess\FormMaker\Models\Form\Inputs;

use Chess\FormMaker\Scopes\InputScope;
use Chess\FormMaker\Traits\Properties\HasReadonly;

class Image extends Input
{
    use HasReadonly;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        static::addGlobalScope(new InputScope('image'));

        parent::boot();
    }

    // HTML PROPERTIES METHODS
    // ==============================================================

    /**
     * Specifies the alt of the input field image element.
     *
     * @param string $alt
     * @return self
     */
    public function propertyAlt(?string $alt): self
    {
        $this->html_properties = ['alt' => $alt];

        return $this;
    }

    /**
     * Specifies the height of the input field image element.
     *
     * @param int $height
     * @return self
     */
    public function propertyHeight(?int $height = 0): self
    {
        $this->html_properties = ['height' => $height];

        return $this;
    }

    /**
     * Specifies the src of the input field image element.
     *
     * @param string $src
     * @return self
     */
    public function propertySrc(?string $src): self
    {
        $this->html_properties = ['src' => $src];

        return $this;
    }

    /**
     * Specifies the width of the input field image element.
     *
     * @param int $width
     * @return self
     */
    public function propertyWidth(?int $width = 0): self
    {
        $this->html_properties = ['width' => $width];

        return $this;
    }
}
