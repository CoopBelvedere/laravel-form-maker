<?php

namespace Belvedere\FormMaker\Models\Inputs\Password;

use Belvedere\FormMaker\{
    Contracts\Inputs\Password\PassworderContract,
    Models\Inputs\Input,
    Scopes\ModelScope
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

        static::addGlobalScope(new ModelScope('password'));
    }

    /**
     * Passworder constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'autocomplete',
            'maxlength',
            'minlength',
            'pattern',
            'placeholder',
            'readonly',
            'required',
            'size',
        ]);
    }
}
