<?php

namespace Belvedere\FormMaker\Traits\Properties;

trait HasRequired
{
    /**
     * Specifies that an input field must be filled out before submitting the form.
     *
     * @param string $required
     * @return self
     */
    public function htmlRequired(?string $required = 'required'): self
    {
        $this->html_attributes = ['required' => $required];

        return $this;
    }
}
