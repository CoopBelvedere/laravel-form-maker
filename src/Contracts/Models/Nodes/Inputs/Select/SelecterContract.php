<?php

namespace Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Select;

use Belvedere\FormMaker\Contracts\{
    Models\Nodes\Inputs\InputContract,
    Traits\Nodes\HasOptionsContract
};

interface SelecterContract extends HasOptionsContract, InputContract
{
    //
}