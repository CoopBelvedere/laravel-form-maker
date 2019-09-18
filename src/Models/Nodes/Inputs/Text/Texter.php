<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Text;

use Belvedere\FormMaker\{
    Contracts\Inputs\Text\TexterContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

class Texter extends Input implements TexterContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('text'));
    }

    /**
     * Texter constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'maxlength',
            'minlength',
            'pattern',
            'placeholder',
            'size',
            'spellcheck',
        ]);
    }
}
