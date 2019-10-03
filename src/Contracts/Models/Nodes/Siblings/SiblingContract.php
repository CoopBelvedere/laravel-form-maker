<?php

namespace Belvedere\FormMaker\Contracts\Models\Nodes\Siblings;

use Belvedere\FormMaker\Contracts\Models\Nodes\NodeContract;
use Belvedere\FormMaker\Contracts\Traits\Text\HasTextContract;

interface SiblingContract extends HasTextContract, NodeContract
{
    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi();
}
