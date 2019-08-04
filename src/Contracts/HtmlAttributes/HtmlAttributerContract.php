<?php

namespace Belvedere\FormMaker\Contracts\HtmlAttributes;

interface HtmlAttributerContract
{
    /**
     * Set the model html attributes.
     *
     * @param string $name
     * @param $value
     * @return void
     */
    public function __set(string $name, $value): void;

    /**
     * Remove all the current html attributes.
     *
     * @return void
     */
    public function clearHtmlAttributes(): void;

    /**
     * Get all the current htlm attributes.
     *
     * @return array
     */
    public function getHtmlAttributes(): array;
}