<?php

namespace Belvedere\FormMaker\Traits\Properties;

trait HasAutofocus
{
    /**
     * Specifies that the input field should automatically get focus when the page loads.
     *
     * @param string $autofocus
     * @return self
     */
    public function htmlAutofocus(?string $autofocus = 'autofocus'): self
    {
        $this->html_attributes = ['autofocus' => $autofocus];

        return $this;
    }
}
