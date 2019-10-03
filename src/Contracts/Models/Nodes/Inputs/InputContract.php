<?php

namespace Belvedere\FormMaker\Contracts\Models\Nodes\Inputs;

use Belvedere\FormMaker\Contracts\Models\Nodes\NodeContract;
use Belvedere\FormMaker\Contracts\Traits\Nodes\HasLabelContract;
use Belvedere\FormMaker\Contracts\Traits\Rules\HasRulesContract;

interface InputContract extends HasLabelContract, HasRulesContract, NodeContract
{
    /**
     * Return the list of the default html attributes automatically assigned on creation.
     *
     * @return array
     */
    public function getHtmlAttributesAssigned(): array;

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi();
}
