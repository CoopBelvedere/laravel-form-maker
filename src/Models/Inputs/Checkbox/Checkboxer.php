<?php

namespace Belvedere\FormMaker\Models\Inputs\Checkbox;

use Belvedere\FormMaker\Contracts\Inputs\Checkbox\CheckboxerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\ModelScope;

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

        static::addGlobalScope(new ModelScope('checkbox'));
    }

    /**
     * Checkbox constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'checked',
            'required',
        ]);
    }
}
