<?php

namespace Belvedere\FormMaker\Models\Inputs\Datalist;

use Belvedere\FormMaker\Contracts\Inputs\Datalist\DatalisterContract;
use Belvedere\FormMaker\Contracts\Nodes\HasOptionsContract;
use Belvedere\FormMaker\Models\Inputs\Input;
use Belvedere\FormMaker\Scopes\ModelScope;
use Belvedere\FormMaker\Traits\Nodes\HasOptions;

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
