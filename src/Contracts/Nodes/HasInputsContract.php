<?php

namespace Belvedere\FormMaker\Contracts\Nodes;

use Belvedere\FormMaker\Models\Inputs\Input;
use Illuminate\Support\Collection;

interface HasInputsContract extends WithNodesContract
{
    /**
     * Disable all inputs.
     *
     * @return void
     * @throws \Exception
     */
    public function disabled(): void;

    /**
     * Enable all inputs.
     *
     * @return void
     * @throws \Exception
     */
    public function enabled(): void;

    /**
     * Get the input with the specified name property.
     * Alias of getNode
     *
     * @param string $name
     * @return \Belvedere\FormMaker\Models\Inputs\Input|null
     * @throws \Exception
     */
    public function getInput(string $name): ?Input;

    /**
     * Get the model inputs sorted by their position in the ranking.
     * Alias of getNodes
     *
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function inputs(?string $type = null): Collection;
}