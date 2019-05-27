<?php

namespace Belvedere\FormMaker\Models\Inputs\File;

use Belvedere\FormMaker\Contracts\Inputs\File\FilerContract;
use Belvedere\FormMaker\Models\Inputs\Input;
use Belvedere\FormMaker\Scopes\ModelScope;

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

        static::addGlobalScope(new ModelScope('file'));
    }

    /**
     * Filer constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'accept',
            'capture',
            'multiple',
            'required',
        ]);
    }
}
