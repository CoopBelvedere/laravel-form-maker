<?php

namespace Belvedere\FormMaker\Contracts;

use Belvedere\FormMaker\{
    Contracts\HtmlAttributes\HasHtmlAttributesContract,
    Models\Model
};

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
     * @return \Belvedere\FormMaker\Models\Model
     */
    public function saveAndFirst(): Model;
}