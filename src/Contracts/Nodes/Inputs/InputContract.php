<?php

namespace Belvedere\FormMaker\Contracts\Inputs;

use Belvedere\FormMaker\Contracts\{
    Nodes\NodeContract,
    Nodes\Siblings\HasLabelContract,
    Rules\HasRulesContract
};

interface InputContract extends HasRulesContract, HasLabelContract, NodeContract
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