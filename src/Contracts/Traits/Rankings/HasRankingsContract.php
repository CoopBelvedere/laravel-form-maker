<?php

namespace Belvedere\FormMaker\Contracts\Traits\Rankings;

use Belvedere\FormMaker\Models\Nodes\Node;
use Illuminate\Database\Eloquent\Relations\MorphOne;

interface HasRankingsContract
{
    /**
     * Add a node in the ranking.
     *
     * @param  \Belvedere\FormMaker\Models\Nodes\Node $node
     * @return void
     * @throws \Exception
     */
    public function addInRanking(Node $node): void;

    /**
     * Get the model rankings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function ranking(): MorphOne;

    /**
     * Set the ranking provider used by the model.
     *
     * @return void
     */
    public function setRankingProvider(): void;
}
