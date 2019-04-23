<?php

namespace Belvedere\FormMaker\Traits;

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
     * @return mixed
     */
    public function ranking()
    {
        return $this->rankingProvider->getEloquentRelation();
    }
}
