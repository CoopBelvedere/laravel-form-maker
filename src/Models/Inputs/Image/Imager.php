<?php

namespace Belvedere\FormMaker\Models\Inputs\Image;

use Belvedere\FormMaker\Contracts\Inputs\Image\ImagerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInputs;
use Belvedere\FormMaker\Scopes\ModelScope;

class Imager extends AbstractInputs implements ImagerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        static::addGlobalScope(new ModelScope('image'));

        parent::boot();
    }

    /**
     * Imager constructor.
     *
     * @param array $attributes
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        $this->htmlAttributesAvailable = array_merge($this->htmlAttributesAvailable, [
            'alt',
            'height',
            'readonly',
            'src',
            'width',
        ]);
    }
}
