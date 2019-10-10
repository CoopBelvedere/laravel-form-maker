<?php

namespace Belvedere\FormMaker\Contracts\Traits\Nodes;

use Illuminate\Support\Collection;
use Belvedere\FormMaker\Contracts\Traits\Rankings\HasRankingsContract;
use Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Option\OptionerContract;
use Belvedere\FormMaker\Contracts\Traits\Repositories\HasNodeRepositoryContract;

interface HasOptionsContract extends HasNodeRepositoryContract, HasRankingsContract, LabelableContract
{
    /**
     * Add an option input to the parent model.
     *
     * @return \Belvedere\FormMaker\Contracts\Models\Nodes\Inputs\Option\OptionerContract
     */
    public function addOption(): OptionerContract;

    /**
     * Add options to the parent model.
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
     * @return \Illuminate\Support\Collection
     */
    public function options(): Collection;
}
