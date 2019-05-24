<?php

namespace Belvedere\FormMaker\Contracts\HtmlElements;

use Belvedere\FormMaker\Contracts\Inputs\InputsContract;

interface ElementsContract
{
    /**
     * Get the input who owns this element.
     * Alias of elementable.
     *
     * @return \Belvedere\FormMaker\Contracts\Inputs\InputsContract
     */
    public function input(): InputsContract;

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi();
}