<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Time;

use Belvedere\FormMaker\{
    Contracts\Inputs\Time\TimerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

class Timer extends Input implements TimerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('time'));
    }

    /**
     * Timer constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'max',
            'min',
            'step',
        ]);
    }
}
