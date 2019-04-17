<?php

namespace Belvedere\FormMaker\Traits\Properties;

trait HasSize
{
    /**
     * Specifies the size (in characters) for the input field.
     * The default value is 20.
     *
     * @param int $size
     * @return self
     */
    public function htmlSize(?int $size = 20): self
    {
        $this->html_attributes = ['size' => $size];

        return $this;
    }
}
