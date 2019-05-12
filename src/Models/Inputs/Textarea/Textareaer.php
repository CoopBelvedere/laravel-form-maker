<?php

namespace Belvedere\FormMaker\Models\Inputs\Textarea;

use Belvedere\FormMaker\Contracts\Inputs\Textarea\TextareaerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Textareaer extends AbstractInput implements TextareaerContract
{
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

    /**
     * Textareaer constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributesAvailable = array_merge($this->attributesAvailable, [
            'autofocus',
            'cols',
            'readonly',
            'required',
            'rows',
            'spellcheck',
        ]);
    }
}
