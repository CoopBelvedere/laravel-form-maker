<?php

namespace Belvedere\FormMaker\Models\Inputs\Datalist;

use Belvedere\FormMaker\{
    Contracts\Inputs\Datalist\DatalisterContract,
    Contracts\Nodes\HasOptionsContract,
    Contracts\Resources\DatalistResourcerContract,
    Models\Inputs\Input,
    Scopes\ModelScope,
    Traits\Nodes\HasOptions
};
use Illuminate\Http\Resources\Json\JsonResource;

class Datalister extends Input implements DatalisterContract, HasOptionsContract
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

        static::addGlobalScope(new ModelScope('datalist'));
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
