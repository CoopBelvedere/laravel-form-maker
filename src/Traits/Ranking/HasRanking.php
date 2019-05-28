<?php

namespace Belvedere\FormMaker\Traits;

use Belvedere\FormMaker\Contracts\Ranking\RankerContract;
use Belvedere\FormMaker\Models\Model;

trait HasRanking
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
     * @param \Belvedere\FormMaker\Models\Model $node
     * @return void
     * @throws \Exception
     */
    protected function addInRanking(Model $node): void
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
     * Get the model ranking.
     *
     * @return mixed
     */
    public function ranking()
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