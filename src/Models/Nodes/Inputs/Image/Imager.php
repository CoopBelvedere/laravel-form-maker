<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Image;

use Belvedere\FormMaker\{
    Contracts\Inputs\Image\ImagerContract,
    Models\Nodes\Inputs\Input,
    Scopes\NodeScope
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
        static::addGlobalScope(new NodeScope('image'));

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

        $this->setHtmlAttributesAvailable([
            'alt',
            'height',
            'readonly',
            'src',
            'width',
        ]);
    }
}
