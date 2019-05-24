<?php

namespace Belvedere\FormMaker\Models\Inputs\Text;

use Belvedere\FormMaker\Contracts\Inputs\Text\TexterContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Texter extends AbstractInput implements TexterContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('text'));
    }

    /**
     * Texter constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'autocomplete',
            'autofocus',
            'maxlength',
            'minlength',
            'pattern',
            'placeholder',
            'readonly',
            'required',
            'size',
            'spellcheck',
        ]);
    }
}
