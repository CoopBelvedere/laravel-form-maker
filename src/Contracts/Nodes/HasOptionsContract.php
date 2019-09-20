<?php

namespace Belvedere\FormMaker\Contracts\Nodes;

use Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract;

interface HasOptionsContract
{
    /**
     * Add a node to the parent model.
     *
     * @param array $attributes
     * @return \Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract $option
     */
    public function addOption(array $attributes): OptionerContract;
}