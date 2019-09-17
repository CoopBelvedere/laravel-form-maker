<?php

namespace Belvedere\FormMaker\Contracts\Nodes;

use Belvedere\FormMaker\Contracts\ModelContract;

interface NodeContract extends ModelContract
{
    /**
     * Get the model who owns this sibling.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function parent();
}