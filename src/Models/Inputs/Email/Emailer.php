<?php

namespace Belvedere\FormMaker\Models\Inputs\Email;

use Belvedere\FormMaker\Contracts\Inputs\Email\EmailerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInputs;
use Belvedere\FormMaker\Scopes\ModelScope;

class Emailer extends AbstractInputs implements EmailerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ModelScope('email'));
    }

    /**
     * Emailer constructor.
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
            'multiple',
            'pattern',
            'placeholder',
            'readonly',
            'required',
            'size',
        ]);
    }
}
