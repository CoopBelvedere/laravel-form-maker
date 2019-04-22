<?php

namespace Belvedere\FormMaker\Models\Form\Inputs;

use Belvedere\FormMaker\Scopes\InputScope;
use Belvedere\FormMaker\Traits\Attributes\{
    HasReadonly,
    HasRequired
};
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Option extends Input
{
    use HasReadonly, HasRequired;

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

    // HTML PROPERTIES METHODS
    // ==============================================================

    /**
     * Specifies the selected attribute to the option.
     *
     * @param string $selected
     * @return self
     */
    public function htmlSelected(?string $selected = 'selected'): self
    {
        $this->html_attributes = ['selected' => $selected];

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
