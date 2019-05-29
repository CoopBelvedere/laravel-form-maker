<?php

namespace Belvedere\FormMaker\Traits;

use Belvedere\FormMaker\Contracts\Rankings\RankerContract;
use Belvedere\FormMaker\Models\Model;

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
     * @param \Belvedere\FormMaker\Models\Model $node
     * @return void
     * @throws \Exception
     */
    protected function addInRanking(Model $node): void
    {
        if (is_null($this->rankings)) {
            $this->createRanking();
        }

        $this->rankings->add($node);
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

        $this->rankings()->save($ranking);

        $this->load('rankings');
    }

    /**
     * Get the model rankings.
     *
     * @return mixed
     */
    public function rankings()
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