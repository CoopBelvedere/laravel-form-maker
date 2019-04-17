<?php

namespace Belvedere\FormMaker\Traits\Properties;

trait HasMinMaxLength
{
    /**
     * Specifies the maximum allowed length for the input field.
     *
     * @param int $maxlength
     * @return self
     */
    public function htmlMaxlength(?int $maxlength): self
    {
        $this->html_attributes = ['maxlength' => $maxlength];

        return $this;
    }

    /**
     * Specifies the minimum allowed length for the input field.
     *
     * @param int $minlength
     * @return self
     */
    public function htmlMinlength(?int $minlength): self
    {
        $this->html_attributes = ['minlength' => $minlength];

        return $this;
    }
}
