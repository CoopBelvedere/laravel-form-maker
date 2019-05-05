<?php

namespace Belvedere\FormMaker\Contracts\Inputs;

interface InputContract
{
    /**
     * Transform the input to JSON.
     *
     * @return mixed
     */
    public function toApi();

    /**
     * Get the form who owns this input.
     * Alias of inputable.
     *
     * @return mixed
     */
    public function form();
}