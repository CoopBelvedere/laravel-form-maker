<?php

namespace Chess\FormMaker\Traits\Properties;

trait HasAutocomplete
{
    /**
     * Specifies if the browser should autocomplete the form.
     * default: on
     *
     * @param string $autocomplete
     * @return self
     */
    public function propertyAutocomplete(?string $autocomplete = 'on'): self
    {
        $this->html_properties = ['autocomplete' => $autocomplete];

        return $this;
    }
}
