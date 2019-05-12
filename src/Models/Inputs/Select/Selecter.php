<?php

namespace Belvedere\FormMaker\Models\Inputs\Select;

use Belvedere\FormMaker\Contracts\Inputs\HasOptionsContract;
use Belvedere\FormMaker\Contracts\Inputs\Select\SelecterContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\HasRanking;
use Belvedere\FormMaker\Traits\Inputs\HasOptions;

class Selecter extends AbstractInput implements HasOptionsContract, SelecterContract
{
    use HasOptions, HasRanking;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        static::addGlobalScope(new InputScope('select'));

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

        $this->attributesAvailable = array_merge($this->attributesAvailable, [
            'autocomplete',
            'multiple',
            'readonly',
            'required',
            'size'
        ]);
    }
}
