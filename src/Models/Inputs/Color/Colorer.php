<?php

namespace Belvedere\FormMaker\Models\Inputs\Color;

use Belvedere\FormMaker\{
    Contracts\Inputs\Color\ColorerContract,
    Models\Inputs\Input,
    Scopes\ModelScope
};

class Colorer extends Input implements ColorerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ModelScope('color'));
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
