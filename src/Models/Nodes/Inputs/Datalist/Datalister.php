<?php

namespace Belvedere\FormMaker\Models\Nodes\Inputs\Datalist;

use Belvedere\FormMaker\Scopes\NodeScope;
use Belvedere\FormMaker\Traits\Nodes\HasOptions;
use Illuminate\Http\Resources\Json\JsonResource;
use Belvedere\FormMaker\Models\Nodes\Inputs\Input;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Datalist\DatalisterContract;
use Belvedere\FormMaker\Contracts\Http\Resources\Nodes\Inputs\DatalistResourcerContract;

class Datalister extends Input implements DatalisterContract
{
    use HasOptions;

    /**
     * Apply the type scope.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new NodeScope('datalist'));
    }

    /**
     * Transform the datalist to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi(): JsonResource
    {
        return resolve(DatalistResourcerContract::class, ['datalist' => $this]);
    }
}
