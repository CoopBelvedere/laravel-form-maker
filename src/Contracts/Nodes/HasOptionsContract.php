<?php

namespace Belvedere\FormMaker\Contracts\Nodes;

interface HasOptionsContract extends WithNodesContract
{
    /**
     * Get the options that belongs to the input.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphMany
     */
    public function options();

    /**
     * Add options for the input.
     *
     * @param array ...$options
     * @return self
     * @throws \Exception
     */
    public function withOptions(array ...$options);
}