<?php

namespace Belvedere\FormMaker\Contracts\Inputs;

use Belvedere\FormMaker\Contracts\Form\FormContract;

interface InputContract
{
    /**
     * Get the form who owns this input.
     * Alias of inputable.
     *
     * @return mixed
     */
    public function form(): FormContract;

    /**
     * Transform the input to JSON.
     *
     * @return \Illuminate\Http\Resources\Json\JsonResource
     */
    public function toApi();
}