<?php

namespace Belvedere\FormMaker\Traits;

use Belvedere\FormMaker\Contracts\Ranking\RankerContract;
use Belvedere\FormMaker\Listeners\DeleteRanking;
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
     * Boot the listener.
     */
    protected static function bootHasRanking()
    {
        static::retrieved(function (Model $model) {
            $model->load('ranking');
        });

        static::deleted(function (Model $model) {
            event(new DeleteRanking($model));
        });
    }

    /**
     * Add a node in the ranking
     *
     * @param \Belvedere\FormMaker\Models\Model $node
     * @return void
     * @throws \Exception
     */
    protected function addInRanking(Model $node): void
    {
        if (is_null($this->ranking()->first())) {
            $this->createRanking();
        }

        $this->ranking()->first()->add($node);
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
