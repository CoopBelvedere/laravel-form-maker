<?php

namespace Belvedere\FormMaker\Contracts\HtmlAttributes;

interface HasHtmlAttributesContract
{
    /**
     * Mass removal of html attributes to a model.
     *
     * @param array $attributes
     * @return self
     */
    public function removeHtmlAttributes(array $attributes);

    /**
     * Mass assign html attributes to a model.
     *
     * @param array $attributes
     * @return self
     */
    public function withHtmlAttributes(array $attributes);
}