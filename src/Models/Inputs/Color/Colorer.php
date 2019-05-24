<?php

namespace Belvedere\FormMaker\Models\Inputs\Color;

use Belvedere\FormMaker\Contracts\Inputs\Color\ColorerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Colorer extends AbstractInput implements ColorerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('color'));
    }

    /**
     * Color constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'autocomplete',
            'required',
        ]);
    }
}
