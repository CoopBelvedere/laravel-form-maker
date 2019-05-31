<?php

namespace Belvedere\FormMaker\Contracts\Inputs;

use Belvedere\FormMaker\Contracts\HtmlAttributes\HasHtmlAttributesContract;
use Belvedere\FormMaker\Contracts\Nodes\HasSiblingsContract;
use Belvedere\FormMaker\Contracts\Rules\HasRulesContract;

interface InputContract extends HasHtmlAttributesContract, HasRulesContract, HasSiblingsContract
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