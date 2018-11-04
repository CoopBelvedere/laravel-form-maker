<?php

namespace Chess\FormMaker\Traits\Properties;

trait HasSize
{
    /**
     * Specifies the size (in characters) for the input field.
     * The default value is 20.
     *
     * @param int $size
     * @return self
     */
    public function propertySize(?int $size = 20): self
    {
        $this->html_properties = ['size' => $size];

        return $this;
    }
}
