<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Url;

use Belvedere\FormMaker\{
    Contracts\Models\Nodes\Inputs\Url\UrlerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

class Urler extends Input implements UrlerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('url'));
    }

    /**
     * Urler constructor.
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
        ]);
    }
}
