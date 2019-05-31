<?php

namespace Belvedere\FormMaker\Models\Inputs\Time;

use Belvedere\FormMaker\{
    Contracts\Inputs\Time\TimerContract,
    Models\Inputs\Input,
    Scopes\ModelScope
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

        static::addGlobalScope(new ModelScope('time'));
    }

    /**
     * Timer constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'max',
            'min',
            'readonly',
            'required',
            'step',
        ]);
    }
}
