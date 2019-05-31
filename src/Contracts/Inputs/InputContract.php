<?php

namespace Belvedere\FormMaker\Contracts\Inputs;

use Belvedere\FormMaker\Contracts\{
    ModelContract,
    Nodes\HasSiblingsContract,
    Rules\HasRulesContract
};

interface InputContract extends HasRulesContract, HasSiblingsContract, ModelContract
{
    /**
     * Get the model who owns this input.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function parent();

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi();
}