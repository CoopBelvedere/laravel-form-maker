<?php

namespace Belvedere\FormMaker\Traits\Rankings;

use Belvedere\FormMaker\Models\Nodes\Node;
use Illuminate\Database\Eloquent\Relations\MorphOne;
use Belvedere\FormMaker\Contracts\Models\Rankings\RankerContract;

trait HasRankings
{
    /**
     * The current implementation of the RankingContract.
     *
     * @var mixed
     */
    protected $rankingProvider;

    /**
     * Add a node in the ranking.
     *
     * @param  \Belvedere\FormMaker\Models\Nodes\Node $node
     * @return void
     * @throws \Exception
     */
    public function addInRanking(Node $node): void
    {
        if (is_null($this->ranking)) {
            $this->ranking()->save($this->rankingProvider);
            $this->load('ranking');
        }

        $this->ranking->add($node);
    }

    /**
     * Get the model rankings.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function ranking(): MorphOne
    {
        return $this->rankingProvider->getEloquentRelation($this);
    }

    /**
     * Set the ranking provider used by the model.
     *
     * @return void
     */
    public function setRankingProvider(): void
    {
        $this->rankingProvider = resolve(RankerContract::class);
    }
}
