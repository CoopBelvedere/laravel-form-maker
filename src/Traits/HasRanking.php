<?php

namespace Chess\FormMaker\Traits;

use Chess\FormMaker\Listeners\CreateRanking;
use Chess\FormMaker\Listeners\DeleteRanking;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

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
     * @return \Illuminate\Database\Eloquent\Relations\MorphOne
     */
    public function ranking(): MorphOne
    {
        return $this->morphOne('Chess\FormMaker\Models\Ranking', 'rankable');
    }
}
