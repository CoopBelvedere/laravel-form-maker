<?php

namespace Chess\FormMaker\Traits\Properties;

trait HasMultiple
{
    /**
     * Specifies that the user is allowed to enter more than one value in the input field.
     *
     * @param string $multiple
     * @return self
     */
    public function propertyMultiple(?string $multiple = 'multiple'): self
    {
        $this->html_properties = ['multiple' => $multiple];

        return $this;
    }
}
