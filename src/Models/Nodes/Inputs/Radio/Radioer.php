<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Radio;

use Belvedere\FormMaker\{
    Contracts\Inputs\Radio\RadioerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

class Radioer extends Input implements RadioerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('radio'));
    }

    /**
     * Radioer constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->setHtmlAttributesAvailable([
            'checked',
        ]);
    }
}
