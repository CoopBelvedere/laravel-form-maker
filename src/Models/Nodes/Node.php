<?php

namespace Belvedere\FormMaker\Models\Nodes;

use Belvedere\FormMaker\Models\Model;
use Belvedere\FormMaker\Listeners\AddNodeInRanking;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Belvedere\FormMaker\Listeners\RemoveFromRanking;
use Belvedere\FormMaker\Contracts\Models\Nodes\NodeContract;

class Node extends Model implements NodeContract
{
    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'created' => AddNodeInRanking::class,
        'deleted' => RemoveFromRanking::class,
    ];

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
