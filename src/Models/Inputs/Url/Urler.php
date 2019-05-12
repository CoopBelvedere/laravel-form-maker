<?php

namespace Belvedere\FormMaker\Models\Inputs\Url;

use Belvedere\FormMaker\Contracts\Inputs\Url\UrlerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Urler extends AbstractInput implements UrlerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('url'));
    }

    /**
     * Urler constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->attributesAvailable = array_merge($this->attributesAvailable, [
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