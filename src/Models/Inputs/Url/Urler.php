<?php

namespace Belvedere\FormMaker\Models\Inputs\Url;

use Belvedere\FormMaker\{
    Contracts\Inputs\Url\UrlerContract,
    Models\Inputs\Input,
    Scopes\ModelScope
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

        static::addGlobalScope(new ModelScope('url'));
    }

    /**
     * Urler constructor.
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
