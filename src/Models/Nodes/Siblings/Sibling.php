<?php

namespace Belvedere\FormMaker\Models\Nodes\Siblings;

use Belvedere\FormMaker\{
    Contracts\Resources\SiblingResourcerContract,
    Contracts\Siblings\SiblingContract,
    Models\Nodes\Node,
    Traits\Text\HasText
};
use Illuminate\Http\Resources\Json\JsonResource;

class Sibling extends Node implements SiblingContract
{
    use HasText;

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi(): JsonResource
    {
        return resolve(SiblingResourcerContract::class, ['sibling' => $this]);
    }
}