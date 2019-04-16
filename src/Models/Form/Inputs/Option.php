<?php

namespace Chess\FormMaker\Models\Form\Inputs;

use Chess\FormMaker\Scopes\InputScope;
use Chess\FormMaker\Traits\Properties\{
    HasReadonly,
    HasRequired
};
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Option extends Input
{
    use HasReadonly, HasRequired;

    /**
     * The properties automatically assigned on creation.
     *
     * @var array
     */
    public $assignedProperties = [];

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

    // HTML PROPERTIES METHODS
    // ==============================================================

    /**
     * Specifies the selected attribute to the option.
     *
     * @param string $selected
     * @return self
     */
    public function propertySelected(?string $selected = 'selected'): self
    {
        $this->html_properties = ['selected' => $selected];

        return $this;
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
