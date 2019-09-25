<?php

namespace Belvedere\FormMaker\Contracts\Models\Nodes\Inputs;

use Belvedere\FormMaker\Contracts\{
    Models\Nodes\NodeContract,
    Traits\Nodes\HasLabelContract,
    Traits\Rules\HasRulesContract
};

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