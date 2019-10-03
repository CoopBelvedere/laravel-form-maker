<?php

namespace Belvedere\FormMaker\Models\Nodes\Siblings;

use Belvedere\FormMaker\Models\Nodes\Node;
use Belvedere\FormMaker\Traits\Text\HasText;
use Illuminate\Http\Resources\Json\JsonResource;
use Belvedere\FormMaker\Contracts\Models\Nodes\Siblings\SiblingContract;
use Belvedere\FormMaker\Contracts\Http\Resources\Nodes\Siblings\SiblingResourcerContract;

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
