<?php

namespace Belvedere\FormMaker\Contracts\Nodes;

use Belvedere\FormMaker\Contracts\Ranking\HasRankingContract;
use Belvedere\FormMaker\Models\Model;

interface WithNodesContract extends HasRankingContract
{
    /**
     * Add a node to the parent model.
     *
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function add(string $type, ?string $name = null): Model;

    /**
     * Add a node after another node.
     *
     * @param string $afterNodeKey
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function addAfter(string $afterNodeKey, string $type, ?string $name = null): Model;

    /**
     * Add a node at a specific rank in the ranking.
     *
     * @param int $rank
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function addAtRank(int $rank, string $type, ?string $name = null): Model;

    /**
     * Add a node before another node.
     *
     * @param string $beforeNodeKey
     * @param string $type
     * @param string|null $name
     * @return \Belvedere\FormMaker\Models\Model
     * @throws \Exception
     */
    public function addBefore(string $beforeNodeKey, string $type, ?string $name = null): Model;


}