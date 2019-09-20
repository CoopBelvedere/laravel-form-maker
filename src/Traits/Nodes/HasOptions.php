<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Contracts\{
    Inputs\Option\OptionerContract,
    Repositories\NodeRepositoryContract
};

trait HasOptions
{
    /**
     * Add a node to the parent model.
     *
     * @param array $attributes
     * @return \Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract $option
     */
    public function addOption(array $attributes): OptionerContract
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $option = $nodeRepository->create($this, 'option')
            ->withHtmlAttributes($attributes)
            ->saveAndFirst();

        $this->addInRanking($option);

        return $option;
    }

    /**
     * Add options for the input.
     *
     * @param array ...$options
     * @return self
     * @throws \Exception
     */
    public function addOptions(array ...$options): self
    {
        dd($options);
    }
}