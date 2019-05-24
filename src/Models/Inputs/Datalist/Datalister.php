<?php

namespace Belvedere\FormMaker\Models\Inputs\Datalist;

use Belvedere\FormMaker\Contracts\Inputs\Datalist\DatalisterContract;
use Belvedere\FormMaker\Contracts\Inputs\HasOptionsContract;
use Belvedere\FormMaker\Models\Inputs\AbstractInput;
use Belvedere\FormMaker\Scopes\ModelScope;
use Belvedere\FormMaker\Traits\HasRanking;
use Belvedere\FormMaker\Traits\Inputs\HasOptions;

class Datalister extends AbstractInput implements DatalisterContract, HasOptionsContract
{
    use HasOptions, HasRanking;

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
