<?php

namespace Belvedere\FormMaker\Models\Inputs\Textarea;

use Belvedere\FormMaker\Contracts\Inputs\Textarea\TextareaerContract;
use Belvedere\FormMaker\Models\Inputs\Input;
use Belvedere\FormMaker\Scopes\ModelScope;

class Textareaer extends Input implements TextareaerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ModelScope('textarea'));
    }

    /**
     * Textareaer constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'autofocus',
            'cols',
            'readonly',
            'required',
            'rows',
            'spellcheck',
        ]);
    }
}
