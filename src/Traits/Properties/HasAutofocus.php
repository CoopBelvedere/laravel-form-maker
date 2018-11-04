<?php

namespace Chess\FormMaker\Traits\Properties;

trait HasAutofocus
{
    /**
     * Specifies that the input field should automatically get focus when the page loads.
     *
     * @param string $autofocus
     * @return self
     */
    public function propertyAutofocus(?string $autofocus = 'autofocus'): self
    {
        $this->html_properties = ['autofocus' => $autofocus];

        return $this;
    }
}
