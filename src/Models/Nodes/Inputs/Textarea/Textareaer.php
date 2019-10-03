<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Textarea;

use Belvedere\FormMaker\Scopes\NodeScope;
use Belvedere\FormMaker\Models\Nodes\Inputs\Input;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Textarea\TextareaerContract;

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
