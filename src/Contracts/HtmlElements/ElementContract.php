<?php

namespace Belvedere\FormMaker\Contracts\HtmlElements;

use Belvedere\FormMaker\Contracts\Inputs\InputContract;

interface ElementContract
{
    /**
     * Get the input who owns this element.
     * Alias of elementable.
     *
     * @return \Belvedere\FormMaker\Contracts\Inputs\InputContract
     */
    public function input(): InputContract;

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi();
}