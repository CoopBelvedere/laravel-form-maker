<?php

namespace Belvedere\FormMaker\Models\Inputs\Datalist;

use Belvedere\FormMaker\{
    Contracts\Inputs\Datalist\DatalisterContract,
    Contracts\Nodes\HasOptionsContract,
    Models\Inputs\Input,
    Scopes\ModelScope,
    Traits\Nodes\HasOptions
};

class Datalister extends Input implements DatalisterContract, HasOptionsContract
{
    use HasOptions;

    /**
     * The attributes automatically assigned on creation.
     *
     * @var array
     */
    protected $htmlAttributesAssigned = [
        'id'
    ];

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new ModelScope('datalist'));
    }
}
