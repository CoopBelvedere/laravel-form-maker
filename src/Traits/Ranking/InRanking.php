<?php


namespace Belvedere\FormMaker\Traits\Ranking;

use Belvedere\FormMaker\Listeners\RemoveFromRanking;
use Illuminate\Database\Eloquent\Model;

trait InRanking
{
    /**
     * The model position in the ranking.
     *
     * @var int
     */
    public $rank = 0;

    /**
     * Boot the listener.
     */
    protected static function bootHasRanking()
    {
        static::deleted(function (Model $model) {
            event(new RemoveFromRanking($model));
        });
    }
}