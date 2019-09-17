<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Date;

use Belvedere\FormMaker\{
    Contracts\Inputs\Date\DaterContract,
    Models\Nodes\Inputs\Input, Scopes\NodeScope
};

class Dater extends Input implements DaterContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('date'));
    }

    /**
     * Date constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setHtmlAttributesAvailable([
            'max',
            'min',
            'step',
        ]);
    }
}
