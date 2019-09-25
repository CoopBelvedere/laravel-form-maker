<?php

namespace Belvedere\FormMaker\Contracts\Models\Nodes;

use Belvedere\FormMaker\Contracts\Models\ModelContract;

interface NodeContract extends ModelContract
{
    /**
     * Get the model who owns this sibling.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function parent();
}