<?php

namespace Belvedere\FormMaker\Traits;

use Belvedere\FormMaker\Contracts\Ranking\RankerContract;
use Belvedere\FormMaker\Listeners\CreateRanking;
use Belvedere\FormMaker\Listeners\DeleteRanking;
use Illuminate\Database\Eloquent\Model;

trait HasRanking
{
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
     * @return \Belvedere\FormMaker\Models\Ranking\Ranker
     */
    public function ranking(): RankerContract
    {
        return $this->rankingProvider->getEloquentRelation($this)->first();
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
