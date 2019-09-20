<?php

namespace Belvedere\FormMaker\Contracts\Nodes;

use Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract;

interface HasOptionsContract
{
    /**
     * Add an option for the input.
     *
     * @param array $attributes
     * @return \Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract $option
     */
    public function addOption(array $attributes): OptionerContract;

    /**
     * Add options for the input.
     *
     * @param array ...$options
     * @return array
     */
    public function addOptions(array ...$options): array;
}