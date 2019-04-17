<?php

namespace Belvedere\FormMaker\Traits\Properties;

trait HasAutocomplete
{
    /**
     * Specifies if the browser should autocomplete the form.
     * default: on
     *
     * @param string $autocomplete
     * @return self
     */
    public function htmlAutocomplete(?string $autocomplete = 'on'): self
    {
        $this->html_attributes = ['autocomplete' => $autocomplete];

        return $this;
    }
}
