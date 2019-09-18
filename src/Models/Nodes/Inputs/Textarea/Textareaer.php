<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Textarea;

use Belvedere\FormMaker\{
    Contracts\Inputs\Textarea\TextareaerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

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

        static::addGlobalScope(new NodeScope('textarea'));
    }

    /**
     * Textareaer constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'cols',
            'rows',
            'spellcheck',
        ]);
    }
}
