<?php

namespace Belvedere\FormMaker\Traits;

use Belvedere\FormMaker\Contracts\Ranking\RankerContract;
use Belvedere\FormMaker\Listeners\CreateRanking;
use Belvedere\FormMaker\Listeners\DeleteRanking;
use Illuminate\Database\Eloquent\Model;

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
        static::created(function (Model $model) {
            event(new CreateRanking($model));
        });

        static::retrieved(function (Model $model) {
            $model->load('ranking');
        });

        static::deleted(function (Model $model) {
            event(new DeleteRanking($model));
        });
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
