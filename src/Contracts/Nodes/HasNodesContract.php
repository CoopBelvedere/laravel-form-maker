<?php

namespace Belvedere\FormMaker\Contracts\Nodes;

use Belvedere\FormMaker\Contracts\Ranking\HasRankingContract;

interface HasNodesContract extends HasRankingContract
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
}