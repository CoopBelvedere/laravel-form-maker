<?php

namespace Belvedere\FormMaker\Contracts\Nodes;

use Belvedere\FormMaker\Contracts\{
    Inputs\Option\OptionerContract,
    Rankings\HasRankingsContract
};
use Illuminate\Support\LazyCollection;

interface HasOptionsContract extends HasRankingsContract
{
    /**
     * Add an option for the input.
     *
     * @param array $attributes
     * @return \Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract $option
     */
    public function addOption(array $attributes): OptionerContract;

    /**
     * Add options for the input.
     *
     * @param array ...$options
     * @return array
     */
    public function addOptions(array ...$options): array;

    /**
     * Get the option with the specified key.
     *
     * @param mixed $key
     * @return \Belvedere\FormMaker\Contracts\Inputs\Option\OptionerContract|null
     */
    public function option($key): ?OptionerContract;

    /**
     * Get the options sorted by their position in the ranking.
     *
     * @return \Illuminate\Support\LazyCollection|null
     */
    public function options(): ?LazyCollection;
}