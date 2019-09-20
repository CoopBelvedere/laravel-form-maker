<?php

namespace Belvedere\FormMaker\Contracts\Siblings;

use Belvedere\FormMaker\Contracts\{
    Nodes\NodeContract,
    Text\HasTextContract
};

interface SiblingContract extends HasTextContract, NodeContract
{
    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi();
}