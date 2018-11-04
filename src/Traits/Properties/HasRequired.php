<?php

namespace Chess\FormMaker\Traits\Properties;

trait HasRequired
{
    /**
     * Specifies that an input field must be filled out before submitting the form.
     *
     * @param string $required
     * @return self
     */
    public function propertyRequired(?string $required = 'required'): self
    {
        $this->html_properties = ['required' => $required];

        return $this;
    }
}
