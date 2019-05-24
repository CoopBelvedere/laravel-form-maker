<?php

namespace Belvedere\FormMaker\Models\Inputs\Email;

use Belvedere\FormMaker\Contracts\Inputs\Email\EmailerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Emailer extends AbstractInput implements EmailerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('email'));
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
