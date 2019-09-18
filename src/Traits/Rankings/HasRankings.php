<?php

namespace Belvedere\FormMaker\Traits\Rankings;

use Belvedere\FormMaker\{
    Contracts\Rankings\RankerContract,
    Models\Nodes\Node
};
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait HasRankings
{
    /**
     * The current implementation of the RankingContract
     *
     * @var mixed
     */
    protected $rankingProvider;

    /**
     * Add a node in the ranking
     *
     * @param  \Belvedere\FormMaker\Models\Nodes\Node $node
     * @return void
     * @throws \Exception
     */
    protected function addInRanking(Node $node): void
    {
        if (is_null($this->ranking)) {
            $this->createRanking();
        }

        $this->ranking->add($node);
    }

    /**
     * Create a ranking
     *
     * @return void
     */
    protected function createRanking(): void
    {
        $ranking = resolve(RankerContract::class);

        $ranking->ranks = [];

        $this->ranking()->save($ranking);

        $this->load('ranking');
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