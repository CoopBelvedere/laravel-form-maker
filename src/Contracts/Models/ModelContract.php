<?php

namespace Belvedere\FormMaker\Contracts\Models;

use Belvedere\FormMaker\Contracts\Traits\HtmlAttributes\HasHtmlAttributesContract;

interface ModelContract extends HasHtmlAttributesContract
{
    /**
     * Return the list of the default html attributes automatically assigned on creation.
     *
     * @param array $attributes
     * @return void
     */
    public function addAvailableAttributes(array $attributes): void;

    /**
     * Save the model and return itself.
     *
     * @return self
     */
    public function saveAndFirst();
}