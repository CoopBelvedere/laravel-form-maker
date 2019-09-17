<?php

namespace Belvedere\FormMaker\Models\Nodes;

use Belvedere\FormMaker\Contracts\Nodes\NodeContract;
use Belvedere\FormMaker\Models\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Node extends Model implements NodeContract
{
    /**
     * Node constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->table = config('form-maker.database.form_nodes_table', 'form_nodes');
    }

    // ELOQUENT RELATIONSHIPS
    // ==============================================================

    /**
     * Get the model who owns this input.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function parent(): MorphTo
    {
        return $this->morphTo('nodable');
    }
}