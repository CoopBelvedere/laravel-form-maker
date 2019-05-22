<?php

namespace Belvedere\FormMaker\Models\Inputs\Option;

use Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract;
use Belvedere\FormMaker\Contracts\Text\HasTextContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\Text\HasText;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Optioner extends AbstractInput implements HasTextContract, OptionerContract
{
    use HasText;

    /**
     * The attributes automatically assigned on creation.
     *
     * @var array
     */
    public $assignedAttributes = [];

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('option'));
    }

    /**
     * Optioner constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributesAvailable = array_merge($this->attributesAvailable, [
            'readonly',
            'required',
            'selected',
        ]);
    }

    // ELOQUENT RELATIONSHIPS
    // ==============================================================

    /**
     * Get the parent owning this option.
     * Alias of inputable.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function parent(): MorphTo
    {
        return $this->inputable();
    }
}
