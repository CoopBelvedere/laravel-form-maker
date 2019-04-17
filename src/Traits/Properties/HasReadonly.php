<?php

namespace Belvedere\FormMaker\Traits\Properties;

trait HasReadonly
{
    /**
     * Specifies that the input field is read only (cannot be changed).
     *
     * @param string $readonly
     * @return self
     */
    public function htmlReadonly(?string $readonly = 'readonly'): self
    {
        $this->html_attributes = ['readonly' => $readonly];

        return $this;
    }
}
