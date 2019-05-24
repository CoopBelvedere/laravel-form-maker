<?php

namespace Belvedere\FormMaker\Contracts\Inputs\Option;

use Belvedere\FormMaker\Contracts\Inputs\InputsContract;

interface OptionerContract extends InputsContract
{
    /**
     * Get the parent owning this option.
     *
     * @return mixed
     */
    public function parent();
}