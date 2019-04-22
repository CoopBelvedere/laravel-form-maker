<?php

namespace Belvedere\FormMaker\Traits;

use Belvedere\FormMaker\Listeners\CreateRanking;
use Belvedere\FormMaker\Listeners\DeleteRanking;
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
        return $this->morphOne('Belvedere\FormMaker\Models\Ranking', 'rankable');
    }
}
