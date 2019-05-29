<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Models\Inputs\Input;
use Illuminate\Support\Collection;

trait HasInputs
{
    /**
     * Disable all inputs.
     *
     * @return void
     * @throws \Exception
     */
    public function disabled(): void
    {
        $this->setInputUsability('disabled');
    }

    /**
     * Enable all inputs.
     *
     * @return void
     * @throws \Exception
     */
    public function enabled(): void
    {
        $this->setInputUsability();
    }

    /**
     * Get the input with the specified name property.
     * Alias of getNode
     *
     * @param string $name
     * @return \Belvedere\FormMaker\Models\Inputs\Input|null
     * @throws \Exception
     */
    public function getInput(string $name): ?Input
    {
        return $this->getNode($name);
    }

    /**
     * Get the model inputs sorted by their position in the ranking.
     * Alias of getNodes
     *
     * @param string|null $type
     * @return \Illuminate\Support\Collection
     * @throws \Exception
     */
    public function inputs(?string $type = null): Collection
    {
        return $this->getNodes('inputs', $type);
    }

    /**
     * Set whether the inputs are disabled or not.
     *
     * @param string|null $disabled
     * @throws \Exception
     */
    protected function setInputUsability(?string $disabled = null): void
    {
        foreach ($this->inputs() as $input) {
            $input->withHtmlAttributes(['disabled' => $disabled])->save();
        }
    }
}