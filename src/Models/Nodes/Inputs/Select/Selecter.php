<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Select;

use Belvedere\FormMaker\Scopes\NodeScope;
use Belvedere\FormMaker\Traits\Nodes\HasOptions;
use Belvedere\FormMaker\Models\Nodes\Inputs\Input;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Select\SelecterContract;

class Selecter extends Input implements SelecterContract
{
    use HasOptions;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        static::addGlobalScope(new NodeScope('select'));

        parent::boot();
    }

    /**
     * Selecter constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'multiple',
            'size',
        ]);
    }
}
