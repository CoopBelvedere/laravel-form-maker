<?php

namespace Belvedere\FormMaker\Models\Inputs\Radio;

use Belvedere\FormMaker\Contracts\Inputs\Radio\RadioerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Radioer extends AbstractInput implements RadioerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('radio'));
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
