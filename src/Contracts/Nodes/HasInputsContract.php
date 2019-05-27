<?php

namespace Belvedere\FormMaker\Contracts\Inputs;

use Belvedere\FormMaker\Contracts\Nodes\HasNodesContract;
use Illuminate\Support\Collection;

interface HasInputsContract extends HasNodesContract
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
     *
     * @param string $name
     * @return mixed
     * @throws \Exception
     */
    public function getInput(string $name);

    /**
     * Get the model inputs sorted by their position in the ranking.
     *
     * @param string $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function inputs(string $type = ''): Collection;
}