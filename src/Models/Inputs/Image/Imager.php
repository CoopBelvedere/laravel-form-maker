<?php

namespace Belvedere\FormMaker\Models\Inputs\Image;

use Belvedere\FormMaker\Contracts\Inputs\Image\ImagerContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\InputScope;

class Imager extends AbstractInput implements ImagerContract
{
    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        static::addGlobalScope(new InputScope('image'));

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

        $this->attributesAvailable = array_merge($this->attributesAvailable, [
            'alt',
            'height',
            'readonly',
            'src',
            'width',
        ]);
    }
}
