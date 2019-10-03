<?php

namespace Belvedere\FormMaker\Contracts\Traits\HtmlAttributes;

interface HasHtmlAttributesContract
{
    /**
     * Mass removal of html attributes to a model.
     *
     * @param array $attributes
     * @return \Belvedere\FormMaker\Contracts\Traits\HtmlAttributes\HasHtmlAttributesContract
     */
    public function removeHtmlAttributes(array $attributes): HasHtmlAttributesContract;

    /**
     * Set the model html attributes.
     *
     * @param  array $attributes
     * @return void
     */
    public function setHtmlAttributesAttribute(array $attributes): void;

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
     * @return \Belvedere\FormMaker\Contracts\Traits\HtmlAttributes\HasHtmlAttributesContract
     */
    public function withHtmlAttributes(array $attributes): HasHtmlAttributesContract;
}
