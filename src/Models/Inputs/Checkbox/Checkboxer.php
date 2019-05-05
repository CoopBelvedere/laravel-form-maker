<?php

namespace Belvedere\FormMaker\Models\Inputs\Checkbox;

use Belvedere\FormMaker\Contracts\Inputs\Checkbox\CheckboxerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Checkboxer extends AbstractInput implements CheckboxerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('checkbox'));
    }

    /**
     * Checkbox constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributesAvailable = array_merge($this->attributesAvailable, [
            'checked',
            'required',
        ]);
    }
}
