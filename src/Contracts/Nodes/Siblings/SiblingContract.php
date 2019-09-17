<?php

namespace Belvedere\FormMaker\Contracts\Siblings;

use Belvedere\FormMaker\Contracts\Nodes\NodeContract;

interface SiblingContract extends NodeContract
{
    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi();
}