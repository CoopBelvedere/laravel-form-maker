<?php

namespace Belvedere\FormMaker\Models\Inputs\Date;

use Belvedere\FormMaker\Contracts\Inputs\Date\DaterContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Dater extends AbstractInput implements DaterContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('date'));
    }

    /**
     * Date constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlhtmlAttributesAvailable = array_merge($this->htmlhtmlAttributesAvailable, [
            'max',
            'min',
            'readonly',
            'required',
            'step',
        ]);
    }
}
