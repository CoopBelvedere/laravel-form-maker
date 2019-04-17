<?php

namespace Chess\FormMaker\Traits\Properties;

trait HasPlaceholder
{
    /**
     * Specifies a hint that describes the expected value of an input field.
     * (a sample value or a short description of the format)
     *
     * @param string $placeholder
     * @return self
     */
    public function htmlPlaceholder(?string $placeholder): self
    {
        $this->html_attributes = ['placeholder' => $placeholder];

        return $this;
    }
}
