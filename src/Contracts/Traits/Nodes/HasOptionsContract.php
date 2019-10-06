<?php

namespace Belvedere\FormMaker\Contracts\Traits\Nodes;

use Illuminate\Support\LazyCollection;
use Belvedere\FormMaker\Contracts\Traits\Rankings\HasRankingsContract;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Option\OptionerContract;

interface HasOptionsContract extends HasRankingsContract
{
    /**
     * Add an option for the input.
     *
     * @param array $attributes
     * @return \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Option\OptionerContract
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
     * @return \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Option\OptionerContract|null
     */
    public function option($key): ?OptionerContract;

    /**
     * Get the options sorted by their position in the ranking.
     *
     * @return \Illuminate\Support\LazyCollection
     */
    public function options(): LazyCollection;
}
