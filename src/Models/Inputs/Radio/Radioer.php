<?php

namespace Belvedere\FormMaker\Models\Inputs\Radio;

use Belvedere\FormMaker\Contracts\Inputs\Radio\RadioerContract;
use Belvedere\FormMaker\Models\Inputs\Input;
use Belvedere\FormMaker\Scopes\ModelScope;

class Radioer extends Input implements RadioerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ModelScope('radio'));
    }

    /**
     * Radioer constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'checked',
            'required'
        ]);
    }
}
