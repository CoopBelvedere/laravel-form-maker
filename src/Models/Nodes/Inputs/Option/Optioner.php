<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Option;

use Belvedere\FormMaker\{
    Contracts\Inputs\Option\OptionerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope,
    Traits\Text\HasText
};

class Optioner extends Input implements OptionerContract
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

        static::addGlobalScope(new NodeScope('option'));
    }

    /**
     * Optioner constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'selected',
        ]);
    }
}
