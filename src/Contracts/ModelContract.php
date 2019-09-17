<?php

namespace Belvedere\FormMaker\Contracts;

use Belvedere\FormMaker\Contracts\HtmlAttributes\HasHtmlAttributesContract;

interface ModelContract extends HasHtmlAttributesContract
{
    /**
     * Return the list of the default html attributes automatically assigned on creation.
     *
     * @param array $attributes
     * @return void
     */
    public function setHtmlAttributesAvailable(array $attributes): void;
}