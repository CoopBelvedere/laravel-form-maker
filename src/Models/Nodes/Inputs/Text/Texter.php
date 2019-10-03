<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Text;

use Belvedere\FormMaker\Scopes\NodeScope;
use Belvedere\FormMaker\Models\Nodes\Inputs\Input;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Text\TexterContract;

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
