<?php

namespace Belvedere\FormMaker\Models\Inputs\Time;

use Belvedere\FormMaker\Contracts\Inputs\Time\TimerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Timer extends AbstractInput implements TimerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('time'));
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
