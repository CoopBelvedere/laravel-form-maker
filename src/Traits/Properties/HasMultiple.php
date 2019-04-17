<?php

namespace Belvedere\FormMaker\Traits\Properties;

trait HasMultiple
{
    /**
     * Specifies that the user is allowed to enter more than one value in the input field.
     *
     * @param string $multiple
     * @return self
     */
    public function htmlMultiple(?string $multiple = 'multiple'): self
    {
        $this->html_attributes = ['multiple' => $multiple];

        return $this;
    }
}
