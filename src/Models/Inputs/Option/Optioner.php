<?php

namespace Belvedere\FormMaker\Models\Inputs\Option;

use Belvedere\FormMaker\{
    Contracts\Inputs\Option\OptionerContract,
    Contracts\Text\HasTextContract,
    Models\Inputs\Input,
    Scopes\ModelScope,
    Traits\Text\HasText
};

class Optioner extends Input implements HasTextContract, OptionerContract
{
    use HasText;

    /**
     * The attributes automatically assigned on creation.
     *
     * @var array
     */
    protected $htmlAttributesAssigned = [];

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ModelScope('option'));
    }

    /**
     * Optioner constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'readonly',
            'required',
            'selected',
        ]);
    }
}
