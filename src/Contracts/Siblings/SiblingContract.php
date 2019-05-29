<?php

namespace Belvedere\FormMaker\Contracts\Siblings;

interface SiblingContract
{
    /**
     * Get the input who owns this element.
     * Alias of siblingable.
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