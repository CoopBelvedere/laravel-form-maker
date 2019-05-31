<?php

namespace Belvedere\FormMaker\Models\Inputs\Image;

use Belvedere\FormMaker\{
    Contracts\Inputs\Image\ImagerContract,
    Models\Inputs\Input,
    Scopes\ModelScope
};

class Imager extends Input implements ImagerContract
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
