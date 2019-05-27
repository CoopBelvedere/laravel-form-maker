<?php

namespace Belvedere\FormMaker\Contracts\HtmlElements;

interface ElementContract
{
    /**
     * Get the input who owns this element.
     * Alias of elementable.
     *
     * @return mixed
     */
    public function input();

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi();
}