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
            ->withHtmlAttributes($attributes);

        if (array_key_exists('text', $attributes)) {
            $option->withText($attributes['text']);
        }

        $this->addInRanking($option);

        return $option->saveAndFirst();
    }

    /**
     * Add options for the input.
     *
     * @param array ...$options
     * @return array
     */
    public function addOptions(array ...$options): array
    {
        $nodes = [];

        foreach ($options as $optionAttributes)
        {
            $nodes[] = $this->addOption($optionAttributes);
        }

        return $nodes;
    }
}