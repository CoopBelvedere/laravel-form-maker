<?php

namespace Belvedere\FormMaker\Models\HtmlAttributes;

use Belvedere\FormMaker\Contracts\HtmlAttributes\HtmlAttributerContract;

class HtmlAttributer implements HtmlAttributerContract
{
    /**
     * Specifies if the browser should autocomplete the form.
     * default: on
     *
     * @param string $autocomplete
     * @return self
     */
    public function autocomplete(?string $autocomplete = 'on'): self
    {
        $this->html_attributes = ['autocomplete' => $autocomplete];

        return $this;
    }
}