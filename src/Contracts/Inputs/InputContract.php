<?php

namespace Belvedere\FormMaker\Contracts\Inputs;

interface InputContract
{
    /**
     * Get the form who owns this input.
     * Alias of inputable.
     *
     * @return mixed
     */
    public function form();

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi();
}