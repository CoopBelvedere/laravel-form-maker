<?php

namespace Chess\FormMaker\Traits\Properties;

trait HasMinMaxLength
{
    /**
     * Specifies the maximum allowed length for the input field.
     *
     * @param int $maxlength
     * @return self
     */
    public function propertyMaxlength(?int $maxlength): self
    {
        $this->html_properties = ['maxlength' => $maxlength];

        return $this;
    }

    /**
     * Specifies the minimum allowed length for the input field.
     *
     * @param int $minlength
     * @return self
     */
    public function propertyMinlength(?int $minlength): self
    {
        $this->html_properties = ['minlength' => $minlength];

        return $this;
    }
}
