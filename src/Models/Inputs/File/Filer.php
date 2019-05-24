<?php

namespace Belvedere\FormMaker\Models\Inputs\File;

use Belvedere\FormMaker\Contracts\Inputs\File\FilerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Filer extends AbstractInput implements FilerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new InputScope('file'));
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
