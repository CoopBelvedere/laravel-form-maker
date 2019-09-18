<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Password;

use Belvedere\FormMaker\{
    Contracts\Inputs\Password\PassworderContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

class Passworder extends Input implements PassworderContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('password'));
    }

    /**
     * Passworder constructor.
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
