<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Email;

use Belvedere\FormMaker\{
    Contracts\Inputs\Email\EmailerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
};

class Emailer extends Input implements EmailerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('email'));
    }

    /**
     * Emailer constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->addAvailableAttributes([
            'maxlength',
            'minlength',
            'multiple',
            'pattern',
            'placeholder',
            'size',
        ]);
    }
}
