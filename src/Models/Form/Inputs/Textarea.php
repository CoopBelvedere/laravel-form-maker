<?php

namespace Chess\FormMaker\Models\Form\Inputs;

use Chess\FormMaker\Scopes\InputScope;
use Chess\FormMaker\Traits\Properties\{
    HasAutofocus,
    HasReadonly,
    HasRequired,
    HasSpellcheck
};

class Textarea extends Input
{
    use HasAutofocus, HasReadonly, HasRequired, HasSpellcheck;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('textarea'));
    }

    // HTML PROPERTIES METHODS
    // ==============================================================

    /**
     * Specifies the visible width of a text area.
     *
     * @param int $cols
     * @return self
     */
    public function propertyCols(?int $cols = 0): self
    {
        $this->html_properties = ['cols' => $cols];

        return $this;
    }

    /**
     * Specifies the visible number of lines in a text area.
     *
     * @param int $rows
     * @return self
     */
    public function propertyRows(?int $rows = 0): self
    {
        $this->html_properties = ['rows' => $rows];

        return $this;
    }
}
