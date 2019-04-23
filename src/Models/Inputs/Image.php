<?php

namespace Belvedere\FormMaker\Models\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\Attributes\HasReadonly;

class Image extends AbstractInput
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
    public function htmlAlt(?string $alt): self
    {
        $this->html_attributes = ['alt' => $alt];

        return $this;
    }

    /**
     * Specifies the height of the input field image element.
     *
     * @param int $height
     * @return self
     */
    public function htmlHeight(?int $height = 0): self
    {
        $this->html_attributes = ['height' => $height];

        return $this;
    }

    /**
     * Specifies the src of the input field image element.
     *
     * @param string $src
     * @return self
     */
    public function htmlSrc(?string $src): self
    {
        $this->html_attributes = ['src' => $src];

        return $this;
    }

    /**
     * Specifies the width of the input field image element.
     *
     * @param int $width
     * @return self
     */
    public function htmlWidth(?int $width = 0): self
    {
        $this->html_attributes = ['width' => $width];

        return $this;
    }
}
