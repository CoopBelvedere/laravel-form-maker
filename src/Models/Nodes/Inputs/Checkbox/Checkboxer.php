<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Checkbox;

use Belvedere\FormMaker\{
    Contracts\Models\Nodes\Inputs\Checkbox\CheckboxerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

class Checkboxer extends Input implements CheckboxerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('checkbox'));
    }

    /**
     * Checkbox constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'checked',
        ]);
    }
}
