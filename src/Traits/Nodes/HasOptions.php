<?php

namespace Belvedere\FormMaker\Traits\Nodes;

use Belvedere\FormMaker\Contracts\{
    Inputs\Option\OptionerContract,
    Repositories\NodeRepositoryContract
};
use Illuminate\Support\LazyCollection;

trait HasOptions
{
    /**
     * Add a node to the parent model.
     *
     * @param array $attributes
     * @return \Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract
     */
    public function addOption(array $attributes): OptionerContract
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $option = $nodeRepository->create($this, 'option', $attributes);

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

        foreach ($options as $optionAttributes) {
            $nodes[] = $this->addOption($optionAttributes);
        }

        return $nodes;
    }

    /**
     * Get the option with the specified key.
     *
     * @param mixed $key
     * @return \Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract|null
     */
    public function option($key): ?OptionerContract
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $option = $nodeRepository->find($this, $key, ['id', 'value']);

        return (!is_null($option) && $option->type === 'option') ? $option : null;
    }

    /**
     * Get the options sorted by their position in the ranking.
     *
     * @return \Illuminate\Support\LazyCollection
     */
    public function options(): LazyCollection
    {
        $nodeRepository = resolve(NodeRepositoryContract::class);

        $options = $nodeRepository->all($this, 'option');

        if ($options->isEmpty()) {
            return $options;
        }

        return $this->ranking->sortByRank($options);
    }
}