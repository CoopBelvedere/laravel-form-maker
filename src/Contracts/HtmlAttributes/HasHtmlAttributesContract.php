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
     * Set the html attributes provider used by the model.
     *
     * @return void
     */
    public function setHtmlAttributesProvider(): void;

    /**
     * Mass assign html attributes to a model.
     *
     * @param array $attributes
     * @return self
     */
    public function withHtmlAttributes(array $attributes);
}