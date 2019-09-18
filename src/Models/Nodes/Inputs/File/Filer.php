<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\File;

use Belvedere\FormMaker\{
    Contracts\Inputs\File\FilerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

class Filer extends Input implements FilerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('file'));
    }

    /**
     * Filer constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'accept',
            'capture',
            'multiple',
        ]);
    }
}
