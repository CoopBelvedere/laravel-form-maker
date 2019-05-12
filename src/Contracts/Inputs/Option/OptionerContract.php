<?php

namespace Belvedere\FormMaker\Contracts\Inputs\Option;

use Belvedere\FormMaker\Contracts\Inputs\InputContract;

interface OptionerContract extends InputContract
{
    /**
     * Get the parent owning this option.
     *
     * @return mixed
     */
    public function parent();
}