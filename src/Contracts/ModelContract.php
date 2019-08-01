<?php

namespace Belvedere\FormMaker\Contracts;

use Belvedere\FormMaker\Contracts\HtmlAttributes\HasHtmlAttributesContract;

interface ModelContract extends HasHtmlAttributesContract
{
    /**
     * Return the list of the default html attributes automatically assigned on creation.
     *
     * @return array
     */
    public function getHtmlAttributesAssigned(): array;

    /**
     * Return the list of additional validation to be applied on the model attributes on update.
     *
     * @return array
     */
    public function getHtmlAttributesRules(): array;
}