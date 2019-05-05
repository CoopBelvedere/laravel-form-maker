<?php

namespace Belvedere\FormMaker\Contracts\Inputs;

use Belvedere\FormMaker\Contracts\Ranking\HasRankingContract;
use Illuminate\Support\Collection;

interface HasInputsContract extends HasRankingContract
{
    /**
     * Add an input to the parent model.
     *
     * @param string $type
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function add(string $type, ?string $name = null);

    /**
     * Add an input after an other input.
     *
     * @param string $afterInputName
     * @param string $type
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function addAfter(string $afterInputName, string $type, ?string $name = null);

    /**
     * Add an input at a specific rank in the ranking.
     *
     * @param int $rank
     * @param string $type
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function addAtRank(int $rank, string $type, ?string $name = null);

    /**
     * Add an input before an other input.
     *
     * @param string $beforeInputName
     * @param string $type
     * @param string|null $name
     * @return mixed
     * @throws \Exception
     */
    public function addBefore(string $beforeInputName, string $type, ?string $name = null);

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