<?php

namespace Belvedere\FormMaker\Models\Nodes\Siblings;

use Belvedere\FormMaker\{
    Contracts\Resources\SiblingResourcerContract,
    Contracts\Siblings\SiblingContract,
    Contracts\Text\HasTextContract,
    Listeners\RemoveFromRanking,
    Models\Nodes\Node,
    Traits\Text\HasText
};
use Illuminate\Http\Resources\Json\JsonResource;

class Sibling extends Node implements HasTextContract, SiblingContract
{
    use HasText;

    /**
     * The event map for the model.
     *
     * @var array
     */
    protected $dispatchesEvents = [
        'deleted' => RemoveFromRanking::class,
    ];

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